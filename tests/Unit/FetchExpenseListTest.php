<?php
namespace Tests\Unit;

use App\Models\Expense;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class FetchExpenseListTest extends SetupExpenseRepository
{
    /**
     * @test
     */
    public function manager_case() {
        $manager = User::where('username' ,'test-manager')->first();
        $actual_result = $this->expense_repository->fetch_expenses_by_role($manager);
        $collection = $actual_result->getCollection();
        $first_expense = $collection[0];
        $this->assertInstanceOf(LengthAwarePaginator::class ,$actual_result);
        $this->assertInstanceOf(Collection::class ,$collection);
        $this->assertInstanceOf(Expense::class ,$first_expense);
    }

    /**
     * @test
     */
    public function employee_case() {
        $employee = User::where('username' ,'test-employee')->first();
        $actual_result = $this->expense_repository->fetch_expenses_by_role($employee);
        $collection = $actual_result->getCollection();
        $first_expense = $collection[0];
        $this->assertInstanceOf(LengthAwarePaginator::class ,$actual_result);
        $this->assertInstanceOf(Collection::class ,$collection);
        $this->assertInstanceOf(Expense::class ,$first_expense);

        foreach($collection as $expense) {
            $this->assertEquals($employee->id ,$expense->employee_id ,'Expense not related to employee');
        }
    }
}
