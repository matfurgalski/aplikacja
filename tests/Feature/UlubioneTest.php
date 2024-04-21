<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Ulubione;
use App\Models\Nieruchomosci;
use App\Models\Ogloszenia;

class UlubioneTest extends TestCase
{ 
    use RefreshDatabase;

    private User $user;



    private function createUser(): User
    {
        return User::factory()->create(['role' => 'wynajmujacy']);
    }

    public function test_ulubione()
    {
  
        $response = $this->actingAs($this->user)->get('/ulubione');

        $response->assertStatus(200);
    }

    public function test_ulubione_pusta_tablica()
    {
       
        $response = $this->actingAs($this->user)->get('/ulubione');

        $response->assertSee(__('Nie znaleziono ulubionego ogłoszenia'));
        $response->assertStatus(200);
    }

    public function test_ulubione_nie_pusta_tablica()
    {
       $nieruchomosci = Nieruchomosci::create([
            'nazwa' => 'Test',
            'opis' =>  'test',
            'powierzchnia' =>  1,
            'liczba_pokoi' =>  1,
            'ulica' =>  'test',
            'kod_pocztowy' =>  'test',
            'miasto' =>  'test',
            'users_id' => $this->user->id,
        ]);

        $ogloszenia = Ogloszenia::create([
            'tytul' => 'Test',
            'wlasciciel_id' => $this->user->id,
            'nieruchomosci_id' => $nieruchomosci->id,
            'opis' => 'Test',
            'cena' => 1
        ]);
        Ulubione::create([
            'users_id' => $this->user->id,
            'ogloszenia_id' => $ogloszenia->id
        ]);

        $response = $this->actingAs($this->user)->get('/ulubione');

        $response->assertDontSee(__('Nie znaleziono ulubionego ogłoszenia'));
        $response->assertSee(__('Test'));
        $response->assertStatus(200);
    }

 

    public function test_pomyslne_usuniecie_ulubione()
    {
      
        $nieruchomosci = Nieruchomosci::create([
            'nazwa' => 'Test',
            'opis' =>  'test',
            'powierzchnia' =>  1,
            'liczba_pokoi' =>  1,
            'ulica' =>  'test',
            'kod_pocztowy' =>  'test',
            'miasto' =>  'test',
            'users_id' => $this->user->id,
        ]);

        $ogloszenia = Ogloszenia::create([
            'tytul' => 'Test',
            'wlasciciel_id' => $this->user->id,
            'nieruchomosci_id' => $nieruchomosci->id,
            'opis' => 'Test',
            'cena' => 1
        ]);
        $ulubione = Ulubione::create([
            'users_id' => $this->user->id,
            'ogloszenia_id' => $ogloszenia->id
        ]);
        
        $response = $this->actingAs($this->user)->delete('ulubione/'.$ulubione->id);
        $response->assertStatus(200);   

        $this->assertDatabaseMissing('ulubione', $ulubione->toArray());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = $this->createUser();
    }
}
