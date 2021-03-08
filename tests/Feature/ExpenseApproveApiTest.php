<?php
namespace Tests\Feature;

use Tests\TestCase;

class ExpenseApproveApiTest extends TestCase
{
    /** @test */
    public function success_case()
    {
        $response = $this->patch('/api/expenses/4/approve' ,['user_id' => 1]);
        
        $response->assertStatus(200);
        $response->assertJsonStructure(['message']);
    }

    /** @test */
    public function failure_case()
    {
        $response = $this->patch('/api/expenses/4/approve' ,['user_id' => 1]);

        $response->assertStatus(400);
    }

    /** @test */
    public function not_exists_case()
    {
        $response = $this->patch('/api/expenses/10/approve' ,['user_id' => 1]);

        $response->assertStatus(404);
    }

    /** @test */
    public function user_not_exists()
    {
        $response = $this->get('/api/expenses/1/approve' ,['user_id' => 10]);

        $response->assertStatus(405);
    }
}
