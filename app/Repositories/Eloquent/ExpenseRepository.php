<?php
namespace App\Repositories\Eloquent;

use App\Models\Expense;
use App\Models\User;
use App\Repositories\ExpenseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class ExpenseRepository implements ExpenseRepositoryInterface {
    protected $model;

    function __construct(Expense $model) {
        $this->model = $model;
    }

    function fetch_expenses_by_role(User $user ,int $limit = 10) {
        return
            $user->role == 'manager' ?
                $this->model->with(['employee' => function ($q) {
                    $q->select('id' ,'name');
                }])->paginate($limit)
                :
                $this->model->where('employee_id' ,$user->id)->paginate($limit);
    }

    function change_expense_status(int $expense_id ,string $status) : bool {
        $expense = $this->model->find($expense_id);
        if ($expense && in_array($status ,['approved' ,'rejected' ,'canceled']))
            return $expense->update(['status' => $status]);
        return false;
    }

    function cancel_expense(int $expense_id, int $employee_id): bool {
        $expense = $this->model->find($expense_id);
        if ($expense && $expense->employee_id == $employee_id)
            return $expense->update(['status' => 'canceled']);
        return false;
    }

    function create_expense(array $attributes) : Model {
        return $this->model->create($attributes);
    }
}