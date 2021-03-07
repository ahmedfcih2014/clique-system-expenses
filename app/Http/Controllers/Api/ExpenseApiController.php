<?php
namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\ExpenseCollection;
use App\Repositories\ExpenseRepositoryInterface;
use Illuminate\Support\Facades\Validator;

class ExpenseApiController extends Controller
{
    protected $expense_repository;

    function __construct(ExpenseRepositoryInterface $repository) {
        $this->expense_repository = $repository;
    }
    
    function index(Request $req) {
        $limit = $req->has('limit') ? $req->limit : 10;
        $user = User::find($req->user_id);
        return ExpenseCollection::collection(
            $this->expense_repository->fetch_expenses_by_role($user ,$limit)
        );
    }

    function show(Request $req ,$id) {
        $employee = $req->has('employee') ? $req->employee : NULL;
        $expense = $this->expense_repository->find_expense($id);
        if ($employee && $expense->employee_id != $req->user_id)
            return response(['message' => 'Expense not found'] ,Response::HTTP_NOT_FOUND);
        return new ExpenseCollection($expense);
    }

    function create(Request $req) {
        // the next block can be finished by a form request for clean code ,@TODO
        $validator = Validator::make($req->all() ,[
            'attachment' => 'required|mimes:pdf,txt,doc,docx,csv,xls,xlsx|max:2048',
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'name' => 'required|max:150'
        ]);
        if ($validator->fails()) {
            $errors = array_map(function ($err) {
                return implode(",", $err);
            }, $validator->errors()->getMessageBag()->messages());
            return response([
                'message' => 'Solve errors first and resubmit your request',
                'errors' => $errors
            ] ,Response::HTTP_FORBIDDEN);
        }
        // form request end here @TODO
        $data = $req->all();
        $data['employee_id'] = $req->employee->id;
        $created = $this->expense_repository->create_expense($data);
        return $this->common_response($created ,'created');
    }

    function cancel(Request $req ,$id) {
        $canceled = $this->expense_repository->cancel_expense($id ,$req->user_id);
        return $this->common_response($canceled ,'canceled');
    }

    function approve($id) {
        $approved = $this->expense_repository->change_expense_status($id ,'approved');
        return $this->common_response($approved ,'approved');
    }

    function reject($id) {
        $rejected = $this->expense_repository->change_expense_status($id ,'rejected');
        return $this->common_response($rejected ,'rejected');
    }

    private function common_response($is_proceed ,$action_name) {
        if ($is_proceed) return response(['message' => 'Expense '.$action_name.' successfully']);
        return response(['message' => 'Can`t proceed this request'] ,Response::HTTP_BAD_REQUEST);
    }
}
