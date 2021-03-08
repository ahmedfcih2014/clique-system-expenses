<?php
namespace Tests\Unit;

use App\Models\Expense;
use Exception;

class FindExpenseTest extends SetupExpenseRepository
{
    /**
     * @test
     */
    public function success_case() {
        $actual_result = $this->expense_repository->find_expense(1);
        $this->assertInstanceOf(Expense::class ,$actual_result);
    }

    /**
     * @test
     */
    public function failure_case() {
        $this->expectException(Exception::class);
        $this->expense_repository->find_expense(1111);// here we try to find not found expense
    }
}
