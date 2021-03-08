<?php
namespace Tests\Unit;

use App\Models\Expense;
use Exception;
use Illuminate\Http\UploadedFile;

class CreateExpenseTest extends SetupExpenseRepository
{
    /**
     * @test
     */
    public function success_case() {
        // here we expect you run FillTestDB seeder first
        $file_path = storage_path('app/public/attachments/attach-1.txt');
        $uploaded_file = new UploadedFile($file_path ,'original-name-.txt' ,'file/text' ,null ,true);
        $attributes = [
            'employee_id' => 2 ,
            'name' => 'Name here' ,
            'date' => date('Y-m-d') ,
            'attachment' =>  $uploaded_file,
            'amount' => 100
        ];
        $actual_result = $this->expense_repository->create_expense($attributes);
        $this->assertInstanceOf(Expense::class ,$actual_result);
    }

    /**
     * @test
     */
    public function failure_case() {
        $this->expectException(Exception::class);
        $this->expense_repository->create_expense([]);
    }
}
