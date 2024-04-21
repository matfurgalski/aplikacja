<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Monitor;
use App\Models\Nieruchomosci;

class MonitorTest extends TestCase
{
   
    use RefreshDatabase;

    private User $user;

    private function createUser(): User
    {
        return User::factory()->create(['role' => 'wynajmujacy']);
    }

    public function test_monitor()
    {
      
        $response = $this->actingAs($this->user)->get('/monitor');

        $response->assertStatus(200);
    }

    public function test_monitor_wykresy()
    {
      
        $response = $this->actingAs(User::factory()->create(['role' => 'wlasciciel']))->get('/monitor/wykresy');

        $response->assertStatus(200);
    }

    public function test_monitor_wlasciciel()
    {
      
        $response = $this->actingAs(User::factory()->create(['role' => 'wlasciciel']))->get('/monitorWlasciciel');

        $response->assertStatus(200);
    }


    protected function setUp(): void
    {
        parent::setUp();

        $this->user = $this->createUser();
    }
}
