<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Nieruchomosci;
use App\Models\Statystyki;

class StatystykiTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    private function createUser(): User
    {
        return User::factory()->create(['role' => 'wlasciciel']);
    }

    public function test_statystyki()
    {
        $wlasciciel = User::factory()->create(['role' => 'wlasciciel']);
        $response = $this->actingAs($wlasciciel)->get('/statystyki');

        $response->assertStatus(200);
    }

    public function test_statystyki_pusta_tablica()
    {
       
        $response = $this->actingAs($this->user)->get('/statystyki');

        $response->assertSee(__('Nie znaleziono statystyk'));
        $response->assertStatus(200);
    }

    public function test_dokumenty_nie_pusta_tablica()
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
    
            $statystyki = Statystyki::create([
                'rodzaj' => 'Test',
                'kwota' =>  1,
                'notatki' =>  'test',
                'kod_pocztowy' =>  'test',
                'users_id' => $this->user->id,
                'nieruchomosci_id' => $nieruchomosc->id,
            ]);

        $response = $this->actingAs($this->user)->get('/statystyki');

        $response->assertDontSee(__('Nie znaleziono statystyk'));
        $response->assertSee(__('Test'));
        $response->assertStatus(200);
    }


    public function test_tworzenie_statystyk()
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

        $statystyki = [
            'rodzaj' => 'Test',
            'kwota' =>  1,
            'notatki' =>  'test',
            'users_id' => $this->user->id,
            'nieruchomosci_id' => $nieruchomosc->id,
        ];
        
        $response = $this->actingAs($this->user)->post('/statystyki', $statystyki);
        $response->assertStatus(302);
        $response->assertRedirect('statystyki');
        $this->assertDatabaseHas('statystyki', $statystyki);
       
       
    }


    public function test_pomyslne_usuniecie_statystyki()
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
    
            $statystyki = Statystyki::create([
                'rodzaj' => 'Test',
                'kwota' =>  1,
                'notatki' =>  'test',
                'kod_pocztowy' =>  'test',
                'users_id' => $this->user->id,
                'nieruchomosci_id' => $nieruchomosc->id,
            ]);
        
        $response = $this->actingAs($this->user)->delete('statystyki/'.$statystyki->id);
        $response->assertStatus(200);
        
        $this->assertDatabaseMissing('statystyki', $statystyki->toArray());
    }


    protected function setUp(): void
    {
        parent::setUp();

        $this->user = $this->createUser();
    }
}
