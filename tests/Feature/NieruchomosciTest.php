<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Nieruchomosci;

class NieruchomosciTest extends TestCase
{
   
    use RefreshDatabase;

    private User $user;

    private function createUser(): User
    {
        return User::factory()->create(['role' => 'wlasciciel']);
    }

    public function test_nieruchomosci()
    {
        $wlasciciel = User::factory()->create(['role' => 'wlasciciel']);
        $response = $this->actingAs($wlasciciel)->get('/nieruchomosci');

        $response->assertStatus(200);
    }

    public function test_nieruchomosci_pusta_tablica()
    {
        $response = $this->actingAs($this->user)->get('/nieruchomosci');
        
        $response->assertSee(__('Nie znaleziono nieruchomości'));
        $response->assertStatus(200);
    }

    public function test_nieruchomosci_nie_pusta_tablica()
    {
        
        Nieruchomosci::create([
            'nazwa' => 'Test',
            'opis' =>  'test',
            'powierzchnia' =>  1,
            'liczba_pokoi' =>  1,
            'ulica' =>  'test',
            'kod_pocztowy' =>  'test',
            'miasto' =>  'test',
            'users_id' => $this->user->id,
        ]);
        $response = $this->actingAs($this->user)->get('/nieruchomosci');

        $response->assertDontSee(__('Nie znaleziono nieruchomości'));
        $response->assertSee(__('Test'));
        $response->assertStatus(200);
    }

    public function test_tworzenie_nieruchomosci()
    {
      

        $nieruchomosc = [
            'nazwa' => 'Test',
            'opis' =>  'test',
            'powierzchnia' =>  1,
            'liczba_pokoi' =>  1,
            'ulica' =>  'test',
            'kod_pocztowy' =>  'test',
            'miasto' =>  'test',
            'users_id' => $this->user->id,
        ];
        
        $response = $this->actingAs($this->user)->post('/nieruchomosci', $nieruchomosc);
        $response->assertStatus(302);
        $response->assertRedirect('nieruchomosci');
        $this->assertDatabaseHas('nieruchomosci', $nieruchomosc);
       
       
    }

    public function test_edycja_nieruchomosci_wartosci_formularza()
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
        
        $response = $this->actingAs($this->user)->get('/nieruchomosci/'.$nieruchomosc->id.'/edit');
        $response->assertStatus(200);
        $response->assertSee('value="'.$nieruchomosc->nazwa.'"', false);
        $response->assertSee('value="'.$nieruchomosc->opis.'"', false);
        $response->assertSee('value="'.$nieruchomosc->powierzchnia.'"', false);
        $response->assertSee('value="'.$nieruchomosc->liczba_pokoi.'"', false);
        $response->assertSee('value="'.$nieruchomosc->ulica.'"', false);
        $response->assertSee('value="'.$nieruchomosc->kod_pocztowy.'"', false);
        $response->assertSee('value="'.$nieruchomosc->miasto.'"', false);
        $response->assertViewHas('nieruchomosci',$nieruchomosc);
       
    }

    public function test_edycja_nieruchomosci_update_error()
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
        
        $response = $this->actingAs($this->user)->post('nieruchomosci/'.$nieruchomosc->id,[
            'nazwa' => ''
        ]);
        $response->assertStatus(500);
    }

    public function test_pomyslne_usuniecie_nieruchomosci()
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
        
        $response = $this->actingAs($this->user)->delete('nieruchomosci/'.$nieruchomosc->id);
        $response->assertStatus(200);

        $this->assertDatabaseMissing('nieruchomosci', $nieruchomosc->toArray());
    }


    protected function setUp(): void
    {
        parent::setUp();

        $this->user = $this->createUser();
    }
}
