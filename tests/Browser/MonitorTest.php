<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;

class MonitorTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function test_dodaj_monitor(): void
    {

        $user1 = User::factory()->create([
            'role' => 'wynajmujacy'
        ]);
        $user2 = User::factory()->create([
            'role' => 'wlasciciel'
        ]);

        $this->browse(function (Browser $first, Browser $second) use ($user1, $user2) {
            $first->visit('/login')
            ->assertSee('Logowanie')
            ->type('email', $user1->email)
            ->type('password', 'password')
            ->press('Zaloguj')
            ->assertPathIs('/wszystkieOgloszenia')

            ->visit('/monitor')
            ->assertSee('Zużycie Mediów')
            ->click('a[class="btn btn-sm btn-outline-secondary"]')
            ->assertSee('Aktualnie nie wynajmujesz żadnej nieruchomości');

            $second->visit('/login')
            ->assertSee('Logowanie')
            ->type('email', $user2->email)
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
                ->click('#button-wpisz');
            });

            $second->type('email', $user1->email)
            ->press('Dodaj')
            ->assertPathIs('/nieruchomosci')
            ->assertSee($user1->email);

            $first->visit('/monitor')
            ->assertSee('Zużycie Mediów')
            ->click('a[class="btn btn-sm btn-outline-secondary"]')
            ->assertSee('Dodaj Zużycie')

            ->type('woda', 1)
            ->type('prad', 1)
            ->type('gaz', 1)
            ->type('notatki', 'test')
            ->press('Dodaj')
            ->assertPathIs('/monitor')
            ->assertSee('test');
        });
    }

}
