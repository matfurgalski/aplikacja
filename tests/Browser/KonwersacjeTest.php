<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;

class KonwersacjeTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
  
    public function test_dodaj_konwersacje(): void
    {
        $user1 = User::factory()->create([

            'role' => 'wlasciciel'
        ]);
      
        $user2 = User::factory()->create([

            'role' => 'wynajmujacy'
        ]);
      

     
        $this->browse(function (Browser $first, Browser $second) use ($user1, $user2)  {
       

            $first->visit('/login')
            ->assertSee('Logowanie')
            ->type('email', $user1->email)
            ->type('password', 'password')
            ->press('Zaloguj')
            ->assertPathIs('/home')
            ->visit('/konwersacje')
            ->assertDontSee('Czesc');

            $second->visit('/login')
            ->assertSee('Logowanie')
            ->type('email', $user2->email)
            ->type('password', 'password')
            ->press('Zaloguj')
            ->assertPathIs('/wszystkieOgloszenia')

            ->visit('/konwersacje')
           ->click('a[class="btn btn-sm btn-outline-secondary"]')
           ->type('email', $user1->email)
           ->type('temat', 'Czesc')
           ->type('wiadomosc', 'Test')
           ->press('Dodaj');

           $first->visit('/konwersacje')
           ->assertSee('Czesc');
   
        });

    
    }

}
