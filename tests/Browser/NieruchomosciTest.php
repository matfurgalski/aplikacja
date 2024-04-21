<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class NieruchomosciTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function test_dodaj_nieruchomosc(): void
    {

     
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
            ->assertSee('Rejestracja')
            ->type('name', 'User')
            ->type('surname', 'User')
            ->type('email', 'user4@op.pl')
            ->type('password', 'password')
            ->type('password_confirmation', 'password')
            ->press('Zarejestruj')
            ->assertPathIs('/home')

            ->click('button[class="btn btn-secondary"]')
            ->click('a[class="dropdown-item"]')
            ->assertSee('Aplikacja')

            ->visit('/login')
            ->assertSee('Logowanie')
            ->type('email', 'user4@op.pl')
            ->type('password', 'password')
            ->press('Zaloguj')
            ->assertPathIs('/home')

            ->visit('/nieruchomosci')
            ->assertSee('Wszystkie Nieruchomości')
            ->click('a[class="btn btn-sm btn-outline-secondary"]')
            ->assertSee('Dodaj Nieruchomość')

            ->type('nazwa', 'test')
            ->type('opis', 'test')
            ->type('powierzchnia', 1)
            ->type('liczba_pokoi', 1)
            ->type('ulica', 'test')
            ->type('kod_pocztowy', 'test')
            ->type('miasto', 'test')
            ->press('Dodaj')

            ->assertPathIs('/nieruchomosci')
            ->assertSee('test');
        });
    }

    public function test_usun_nieruchomosc(): void
    {

     
        $this->browse(function (Browser $browser) {
            $browser->visit('/nieruchomosci')
            ->assertSee('test');

            $browser->with('.table', function (Browser $table) {
                $table->assertSee('test')
                ->click('#button-id')->acceptDialog();
            });
            $browser->visit('/home')
            ->visit('/nieruchomosci')
            ->assertDontSee('test');
        });
    }


}
