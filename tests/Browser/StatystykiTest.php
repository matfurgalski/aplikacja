<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use App\Models\Nieruchomosci;

class StatystykiTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function test_dodaj_statystyke(): void
    {

    
        $user = User::factory()->create([
            'role' => 'wlasciciel'
        ]);
        $nieruchomosc = Nieruchomosci::create([
            'nazwa' => 'Test',
            'opis' =>  'test',
            'powierzchnia' =>  1,
            'liczba_pokoi' =>  1,
            'ulica' =>  'test',
            'kod_pocztowy' =>  'test',
            'miasto' =>  'test',
            'users_id' => $user->id,
        ]);

        $this->browse(function (Browser $browser) use ($user, $nieruchomosc) {
       
            $browser->visit('/login')
            ->assertSee('Logowanie')
            ->type('email', $user->email)
            ->type('password', 'password')
            ->press('Zaloguj')
            ->assertPathIs('/home')

            
            ->visit('/statystyki')
            ->assertSee('Moje Wydatki / Przychody')
            ->click('a[class="btn btn-sm btn-outline-secondary"]')
            ->assertSee('Dodaj Wydatek / Przychód')

            
            ->select('nieruchomosci_id',$nieruchomosc->id)
            ->type('kwota', 1000)
            ->type('notatki', 'test')
            ->press('Dodaj')
            ->assertPathIs('/statystyki')
            ->assertSee('test');
        });
    }

    public function test_usun_statystyke(): void
    {

     
        $this->browse(function (Browser $browser) {
            $browser->visit('/statystyki');

            $browser->with('.table', function (Browser $table) {
                $table->assertSee('test')
                ->click('#button-id');
            });
            $browser->visit('/home')
            ->visit('/statystyki')
            ->assertDontSee('test');
        });

    }
}
