<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class HomeTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    private function createUser(): User
    {
        return User::factory()->create(['role' => 'wlasciciel']);
    }

    public function test_home_wlasciciel()
    {
      
        $response = $this->actingAs($this->user)->get('/home');

        $response->assertStatus(200);
    }

    public function test_home_wynajmujacy()
    {
      
        $response = $this->actingAs(User::factory()->create(['role' => 'wynajmujacy']))->get('/home');

        $response->assertStatus(302);
        $response->assertRedirect('wszystkieOgloszenia');
    }
    

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = $this->createUser();
    }
}
