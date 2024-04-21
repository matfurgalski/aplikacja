<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
class DokumentyTest extends DuskTestCase
{
    use RefreshDatabase;
    /**
     * A Dusk test example.
     * @test
     */
    public function test_dodaj_dokument(): void
    {

     
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
            ->assertSee('Rejestracja')
            ->type('name', 'User')
            ->type('surname', 'User')
            ->type('email', 'user3@op.pl')
            ->type('password', 'password')
            ->type('password_confirmation', 'password')
            ->press('Zarejestruj')
            ->assertPathIs('/home')

            ->click('button[class="btn btn-secondary"]')
            ->click('a[class="dropdown-item"]')
            ->assertSee('Aplikacja')

            ->visit('/login')
            ->assertSee('Logowanie')
            ->type('email', 'user3@op.pl')
            ->type('password', 'password')
            ->press('Zaloguj')
            ->assertPathIs('/home')

            ->visit('/dokumenty')
            ->assertSee('Wszystkie Dokumenty')
            ->click('a[class="btn btn-sm btn-outline-secondary"]')
            ->assertSee('Dodaj Dokument')

            ->type('nazwa', 'test')
            ->attach('plik', __DIR__.'/photos/mountains.jpg')
            ->press('Dodaj')

            ->assertPathIs('/dokumenty')
            ->assertSee('test');
        });

    
    }

    public function test_usun_dokument(): void
    {

     
        $this->browse(function (Browser $browser) {
            $browser->visit('/dokumenty');

            $browser->with('.table', function (Browser $table) {
                $table->assertSee('test')
                ->click('#button-id');
            });
            $browser->visit('/home')
            ->visit('/dokumenty')
            ->assertDontSee('test');
        });

      

    
    }


}
