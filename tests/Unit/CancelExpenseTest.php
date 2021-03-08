<?php
namespace Tests\Unit;

class CancelExpenseTest extends SetupExpenseRepository
{
    /**
     * @test
     */
    public function success_case() {
        $actual_result = $this->expense_repository->cancel_expense(2 ,2);
        $this->assertTrue($actual_result);
    }

    /**
     * @test
     */
    public function failure_case() {
        $actual_result = $this->expense_repository->cancel_expense(2 ,2);
        $this->assertFalse($actual_result);
    }
}
