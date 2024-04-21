<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Konwersacje;

class KonwersacjeTest extends TestCase
{
    use RefreshDatabase;

    private User $user;



    private function createUser(): User
    {
        return User::factory()->create();
    }

    public function test_dokumenty()
    {
  
        $response = $this->actingAs($this->user)->get('/konwersacje');

        $response->assertStatus(200);
    }

    public function test_konwersacje_pusta_tablica()
    {
       
        $response = $this->actingAs($this->user)->get('/konwersacje');

        $response->assertSee(__('Nie znaleziono konwersacji'));
        $response->assertStatus(200);
    }

 
    protected function setUp(): void
    {
        parent::setUp();

        $this->user = $this->createUser();
    }
}
