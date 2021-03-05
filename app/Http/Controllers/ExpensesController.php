<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ExpenseCreateRequest;
use App\Repositories\ExpenseRepositoryInterface;

class ExpensesController extends Controller
{   
    protected $expense_repository;

    function __construct(ExpenseRepositoryInterface $repository) {
        $this->expense_repository = $repository;
    }

    function index() {
        $user = Auth::user();

        $expenses_collection = $this->expense_repository->fetch_expenses_by_role($user);
        $user_role = $user->role;

        return view('expenses.index' ,compact('expenses_collection' ,'user_role'));
    }

    function store(ExpenseCreateRequest $request) {
        $data = $request->all();
        $data['employee_id'] = Auth::id();
        $created = $this->expense_repository->create_expense($data);
        $type = $created ? 'success' : 'error';
        $message = $created ? 'Expense Created' : 'Expense Not Created';
        return $this->index_redirect($type ,$message);
    }

    function cancel($expense_id) {
        $canceled = $this->expense_repository->cancel_expense($expense_id ,Auth::id());
        $type = $canceled ? 'success' : 'error';
        $message = $canceled ? 'Expense Canceled' : 'Expense Not Canceled';
        return $this->index_redirect($type ,$message);
    }

    function approve($expense_id) {
        $approved = $this->expense_repository->change_expense_status($expense_id ,'approved');
        $type = $approved ? 'success' : 'error';
        $message = $approved ? 'Expense Approved' : 'Expense Not Approved';
        return $this->index_redirect($type ,$message);
    }

    function reject($expense_id) {
        $rejected = $this->expense_repository->change_expense_status($expense_id ,'rejected');
        $type = $rejected ? 'success' : 'error';
        $message = $rejected ? 'Expense Rejected' : 'Expense Not Rejected';
        return $this->index_redirect($type ,$message);
    }

    private function index_redirect($type ,$message) {
        return redirect(route('expenses.index'))->with($type ,$message);
    }
}
