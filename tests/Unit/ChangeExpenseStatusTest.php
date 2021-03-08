<?php
namespace Tests\Unit;

class ChangeExpenseStatusTest extends SetupExpenseRepository
{
    /**
     * @test
     */
    public function success_case() {
        $actual_result = $this->expense_repository->change_expense_status(1 ,'approved');
        $this->assertTrue($actual_result);
    }

    /**
     * @test
     */
    public function failure_case() {
        $actual_result = $this->expense_repository->change_expense_status(1 ,'approved');
        $this->assertFalse($actual_result);
    }
}
