<?php
namespace Tests\Unit;

use App\Models\Expense;
use Tests\TestCase;
use App\Repositories\Eloquent\ExpenseRepository;

class SetupExpenseRepository extends TestCase {
    protected $expense_repository;

    function setUp(): void {
        parent::setUp();
        $this->expense_repository = new ExpenseRepository(new Expense());
    }
}