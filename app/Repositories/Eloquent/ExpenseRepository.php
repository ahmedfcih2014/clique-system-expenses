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
        if ($user->role == 'manager')
            return $this->model->with([
                'employee' => function ($q) {
                    $q->select('id' ,'name');
                }])->paginate($limit);
        return $this->model->where('employee_id' ,$user->id)->paginate($limit);
    }

    function change_expense_status(int $expense_id ,string $status) : bool {
        $expense = $this->find_expense($expense_id);
        if (
            $expense &&
            $expense->status == 'pending' &&
            in_array($status ,['approved' ,'rejected'])
        ) return $expense->update(['status' => $status]);
        return false;
    }

    function cancel_expense(int $expense_id, int $employee_id): bool {
        $expense = $this->model->find($expense_id);
        if (
            $expense &&
            $expense->status == 'pending' &&
            $expense->employee_id == $employee_id
        ) return $expense->update(['status' => 'canceled']);
        return false;
    }

    function create_expense(array $attributes) : Model {
        return $this->model->create($attributes);
    }

    function find_expense(int $id) : Model {
        return $this->model->findOrFail($id);
    }
}