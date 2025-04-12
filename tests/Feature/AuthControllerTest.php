<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    public function testLoginSuccessfully()
    {
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => 'password',
            'role' => 'Admin'
        ]);

        $login = [
            'email' => 'admin@example.com',
            'password' => 'password',
        ];

        $response_login = $this->post('/login', $login);
        $response_login->assertRedirect('/');
        $this->assertAuthenticatedAs($user);
    }


    public function testLogoutSuccessfully()
    {
        $response_logout = $this->post('/logout');
        $response_logout->assertRedirect('/login');
        $this->assertGuest();
    }
}
