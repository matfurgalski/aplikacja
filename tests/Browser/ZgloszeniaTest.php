<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use App\Models\Nieruchomosci;

class ZgloszeniaTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function test_dodaj_zgloszenie(): void
    {

        $wynajmujacy = User::factory()->create([
            'role' => 'wynajmujacy'
        ]);
        $wlasciciel = User::factory()->create([
            'role' => 'wlasciciel'
        ]);

        $this->browse(function (Browser $first, Browser $second) use ($wynajmujacy, $wlasciciel) {
            $first->visit('/login')
            ->assertSee('Logowanie')
            ->type('email', $wynajmujacy->email)
            ->type('password', 'password')
            ->press('Zaloguj')
            ->assertPathIs('/wszystkieOgloszenia')

            ->visit('/zgloszenia')
            ->assertSee('Moje zgłoszenia')
            ->click('a[class="btn btn-sm btn-outline-secondary"]')
            ->assertSee('Nie wynajmujesz żadnej nieruchomości, skontaktuj się z właścicielem');

            $second->visit('/login')
            ->assertSee('Logowanie')
            ->type('email', $wlasciciel->email)
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
            ->assertPathIs('/nieruchomosci');
            
            $second->with('.table', function (Browser $table) {
                $table->assertSee('test')
                ->click('#button-wpisz-wynajmujacego');
            });

            $second->type('email', $wynajmujacy->email)
            ->press('Dodaj')
            ->assertPathIs('/nieruchomosci')
            ->assertSee($wynajmujacy->email);

            $first->visit('/zgloszenia')
            ->assertSee('Moje zgłoszenia')
            ->click('a[class="btn btn-sm btn-outline-secondary"]')
            ->assertSee('Dodaj Zgłoszenie')

            ->type('temat', 'test')
            ->type('opis', 'test')
            ->press('Dodaj')
            ->assertPathIs('/zgloszenia')
            ->assertSee('test');
        });
    }
}
