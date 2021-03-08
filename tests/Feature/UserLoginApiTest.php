<?php
namespace Tests\Feature;

use Illuminate\Http\Response;
use Tests\TestCase;

class UserLoginApiTest extends TestCase
{
    /**  @test */
    public function failure_case()
    {
        $response = $this->post('/api/user_login', ['username' => 'ahmed', 'password' => 123456]);
        
        $response->assertStatus(Response::HTTP_BAD_REQUEST);
        $response->assertJsonStructure(['message']);
    }

    /**  @test */
    public function success_case()
    {
        $response = $this->post('/api/user_login', ['username' => 'test-employee', 'password' => 123456]);
        
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure(['message' ,'user_id']);
    }
}
