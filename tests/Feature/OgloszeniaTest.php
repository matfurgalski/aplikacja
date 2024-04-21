<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Nieruchomosci;
use App\Models\Ogloszenia;

class OgloszeniaTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    private function createUser(): User
    {
        return User::factory()->create(['role' => 'wlasciciel']);
    }

    public function test_ogloszenia()
    {
        $response = $this->actingAs($this->user)->get('/ogloszenia');

        $response->assertStatus(200);
    }

    public function test_ogloszenia_pusta_tablica_wlasciciel()
    {
       
        $response = $this->actingAs($this->user)->get('/ogloszenia');

        $response->assertSee(__('Brak ogłoszeń'));
        $response->assertStatus(200);
    }

    public function test_ogloszenia_pusta_tablica_wynajmujacy()
    {
       
        $response = $this->actingAs(User::factory()->create(['role' => 'wynajmujacy']))->get('/wszystkieOgloszenia');

        $response->assertSee(__('Brak ogłoszeń'));
        $response->assertStatus(200);
    }

    public function test_tworzenie_ogloszenia()
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

      $ogloszenia = [
        'tytul' => 'Test',
        'wlasciciel_id' => $this->user->id,
        'nieruchomosci_id' => $nieruchomosc->id,
        'opis' => 'Test',
        'cena' => 1
      ];
        
        $response = $this->actingAs($this->user)->post('/ogloszenia', $ogloszenia);
        $response->assertStatus(302);
        $response->assertRedirect('ogloszenia');
        $this->assertDatabaseHas('ogloszenia', $ogloszenia);
       
       
    }

    public function test_pomyslne_usuniecie_ogloszenia()
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
    
        
        $response = $this->actingAs($this->user)->delete('ogloszenia/'.$ogloszenia->id);
        $response->assertStatus(200);   

        $this->assertDatabaseMissing('ogloszenia', $ogloszenia->toArray());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = $this->createUser();
    }
}
