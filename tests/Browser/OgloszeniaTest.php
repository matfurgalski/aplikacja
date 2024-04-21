<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use App\Models\Nieruchomosci;
class OgloszeniaTest extends DuskTestCase
{
    
    /**
     * A Dusk test example.
     * @test
     * @return void
     */
    public function test_dodaj_ogloszenie(): void
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

            
            ->visit('/ogloszenia')
            ->assertSee('Moje Ogłoszenia')
            ->click('a[class="btn btn-sm btn-outline-secondary"]')
            ->assertSee('Dodaj Ogłoszenie')

            ->type('tytul', 'Test')
            ->type('opis', 'Test')
            ->select('nieruchomosci_id',$nieruchomosc->id)
             ->type('cena', 1000)
            ->attach('plik[]', __DIR__.'/photos/mountains.jpg')
            ->press('Dodaj')
            ->assertPathIs('/ogloszenia')
            ->assertSee('Test');
        });
    }

    public function test_usun_ogloszenie(): void
    {

     
        $this->browse(function (Browser $browser) {
            $browser->visit('/ogloszenia');

            $browser->with('.table', function (Browser $table) {
                $table->assertSee('Test')
                ->click('#button-id');
            });
            $browser->visit('/home')
            ->visit('/ogloszenia')
            ->assertDontSee('Test');
        });

    }
}
