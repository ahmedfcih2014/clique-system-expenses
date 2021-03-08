<?php
namespace Tests\Feature;

use Tests\TestCase;

class ExpenseFetchApiTest extends TestCase
{
    /** @test */
    public function success_case()
    {
        $response = $this->get('/api/expenses/1?user_id=1');
        
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'id' ,'name' ,'date' ,
                'attachment' ,'amount' ,'status' ,
                'employee' => ['id' ,'name']
            ]
        ]);
    }

    /** @test */
    public function failure_case()
    {
        $response = $this->get('/api/expenses/10?user_id=1');

        $response->assertStatus(404);
    }

    /** @test */
    public function user_not_exists()
    {
        $response = $this->get('/api/expenses/1?user_id=10');

        $response->assertStatus(400);
    }
}
