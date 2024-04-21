<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends DuskTestCase
{
    use RefreshDatabase;
    /**
     * A Dusk test example.
     * @test
     * @return void
     */
   
    public function test_rejestracja_uzytkownika(): void
    {

     

        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                    ->assertSee('Rejestracja')
                    ->type('name', 'Julek')
                    ->type('surname', 'Tkacz')
                    ->type('email', 'julek@op.pl')
                    ->type('password', 'julek2024')
                    ->type('password_confirmation', 'julek2024')
                    ->press('Zarejestruj')
                    ->assertPathIs('/home');
        });
    }

 
}
