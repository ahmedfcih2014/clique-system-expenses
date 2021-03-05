<?php
namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

interface ExpenseRepositoryInterface {
    function fetch_expenses_by_role(User $user_role);
    function change_expense_status(int $expense_id ,string $status) : bool;
    function cancel_expense(int $expense_id ,int $employee_id) : bool;
    function create_expense(array $attributes) : Model;
}