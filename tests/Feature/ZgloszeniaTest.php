<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Nieruchomosci;
use App\Models\Zgloszenia;

class ZgloszeniaTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    private function createUser(): User
    {
        return User::factory()->create();
    }

    public function test_zgloszenia()
    {
        $response = $this->actingAs(User::factory()->create(['role' => 'wynajmujacy']))->get('/zgloszenia');

        $response->assertStatus(200);
    }

    public function test_zgloszenia_wlasciciel()
    {
        $response = $this->actingAs(User::factory()->create(['role' => 'wlasciciel']))->get('/zgloszeniaWlasciciel');

        $response->assertStatus(200);
    }

    public function test_zgloszenia_pusta_tablica()
    {
       
        $response = $this->actingAs(User::factory()->create(['role' => 'wynajmujacy']))->get('/zgloszenia');

        $response->assertSee(__('Nie znaleziono zgłoszenia'));
        $response->assertStatus(200);
    }

    public function test_pomyslne_usuniecie_zgloszenia()
    {
      
          $nieruchomosc = Nieruchomosci::create([
            'nazwa' => 'Test',
            'opis' =>  'test',
            'powierzchnia' =>  1,
            'liczba_pokoi' =>  1,
            'ulica' =>  'test',
            'kod_pocztowy' =>  'test',
            'miasto' =>  'test',
            'users_id' => $this->user->id,
      ]);

      $zgloszenia = Zgloszenia::create([
        'temat' => 'Test',
        'users_id' => $this->user->id,
        'nieruchomosci_id' => $nieruchomosc->id,
        'opis' => 'test',
        'status' => 'awaria',
        'typ_zgloszenia' => 'Test'
      ]);
    
        
        $response = $this->actingAs($this->user)->delete('zgloszenia/'.$zgloszenia->id);
        $response->assertStatus(200);   

        $this->assertDatabaseMissing('zgloszenia', $zgloszenia->toArray());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = $this->createUser();
    }
}
