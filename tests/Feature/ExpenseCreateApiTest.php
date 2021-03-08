<?php
namespace Tests\Feature;

use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ExpenseCreateApiTest extends TestCase
{
    /** @test */
    public function success_case()
    {
        $response = $this->post('/api/expenses/create' ,[
            'user_id' => 2,
            'attachment' => $this->get_file(),
            'amount' => rand(100 ,3000),
            'date' => date('Y-m-d'),
            'name' => 'Just from feature test'
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure(['message']);
    }

    /** @test */
    public function failure_validation_case()
    {
        $response = $this->post('/api/expenses/create' ,[
            'user_id' => 2
        ]);

        $response->assertStatus(Response::HTTP_FORBIDDEN);
        $response->assertJsonStructure(['message' ,'errors' => ['name' ,'date' ,'amount' ,'attachment']]);
    }

    /** @test */
    public function user_not_exists_case()
    {
        $response = $this->post('/api/expenses/create' ,[
            'user_id' => 3,
            'attachment' => $this->get_file(),
            'amount' => rand(100 ,3000),
            'date' => date('Y-m-d'),
            'name' => 'Just from feature test'
        ]);

        $response->assertStatus(Response::HTTP_BAD_REQUEST);
        $response->assertJsonStructure(['message']);
    }

    private function get_file() {
        return new UploadedFile(
            storage_path('app/public/attachments/attach-1.txt'),
            date('YmdHis').'-original-name.txt',
            'file/text',
            null,
            true
        );
    }
}
