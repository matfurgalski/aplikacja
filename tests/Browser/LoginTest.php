<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class LoginTest extends DuskTestCase
{
    use RefreshDatabase;
    /**
     * A Dusk test example.
     * @test
     * @return void
     */


    public function test_login_uzytkownika(): void
    {
     
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
            ->assertSee('Rejestracja')
            ->type('name', 'Julek')
            ->type('surname', 'Tkacz')
            ->type('email', 'julek2@op.pl')
            ->type('password', 'julek2024')
            ->type('password_confirmation', 'julek2024')
            ->press('Zarejestruj')

            ->click('button[class="btn btn-secondary"]')
            ->click('a[class="dropdown-item"]')

            ->visit('/login')
            ->assertSee('Logowanie')
            ->type('email', 'julek2@op.pl')
            ->type('password', 'julek2024')
            ->press('Zaloguj')
            ->assertPathIs('/home');

      
        });

    
    }


}
