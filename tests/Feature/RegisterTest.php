<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    public function test_rejestracja()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
    }

    public function test_rejestracja_udana()
    {
        $user = [
            'name' => 'User',
            'surname' => 'UserTest',
            'email' => 'user@user.pl',
            'role' => 'wlasciciel',
            'password' => 'password123',
            'password_confirmation' =>'password123',
        ];
        $response = $this->post('/register',$user);

        $response->assertStatus(302);
        $response->assertRedirect('home');
    }

    public function test_rejestracja_haslo_niepotwierdzone()
    {
        $user = [
            'name' => 'User',
            'surname' => 'UserTest',
            'email' => 'user@user.pl',
            'role' => 'wlasciciel',
            'password' => 'password123',
            'password_confirmation' =>'pass',
        ];
        $response = $this->post('/register',$user);

         $response->assertStatus(302);
         $response->assertRedirect();
         
    }

}
