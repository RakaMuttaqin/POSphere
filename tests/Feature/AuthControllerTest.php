<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    use RefreshDatabase;
    public function testLoginSuccessfully()
    {
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'Admin'
        ]);

        $login = [
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
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
