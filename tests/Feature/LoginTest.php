<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_login()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    public function test_wlasciciel_przekierowany_do_home()
    {
        User::create([
            'name' => 'User',
            'surname' => 'UserTest',
            'email' => 'user@user.pl',
            'role' => 'wlasciciel',
            'password' => bcrypt('password123'),
        ]);
        $response = $this->post('/login',[
            'email' => 'user@user.pl',
            'role' => 'wlasciciel',
            'password' => 'password123',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('home');
    }

    public function test_wynajmujacy_przekierowany_do_home()
    {
        User::create([
            'name' => 'User',
            'surname' => 'UserTest',
            'email' => 'user2@user.pl',
            'role' => 'wynajmujacy',
            'password' => bcrypt('password123'),
        ]);
        $response = $this->post('/login',[
            'email' => 'user2@user.pl',
            'role' => 'wynajmujacy',
            'password' => 'password123',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('home');
    }
 
    public function test_niezarejestrowany_brak_dostepu_do_dokumenty_przekierowanie_login()
    {
        $response = $this->get('/dokumenty');

        $response->assertStatus(302);
        $response->assertRedirect('login');
    }

    public function test_niezarejestrowany_brak_dostepu_do_home_przekierowanie_login()
    {
        $response = $this->get('/home');

        $response->assertStatus(302);
        $response->assertRedirect('login');
    }

    public function test_niezarejestrowany_brak_dostepu_do_konwersacje_przekierowanie_login()
    {
        $response = $this->get('/konwersacje');

        $response->assertStatus(302);
        $response->assertRedirect('login');
    }

    public function test_niezarejestrowany_brak_dostepu_do_monitor_przekierowanie_login()
    {
        $response = $this->get('/monitor');

        $response->assertStatus(302);
        $response->assertRedirect('login');
    }

    public function test_niezarejestrowany_brak_dostepu_do_nieruchomosci_przekierowanie_login()
    {
        $response = $this->get('/nieruchomosci');

        $response->assertStatus(302);
        $response->assertRedirect('login');
    }

    public function test_niezarejestrowany_brak_dostepu_do_ogloszenia_przekierowanie_login()
    {
        $response = $this->get('/ogloszenia');

        $response->assertStatus(302);
        $response->assertRedirect('login');
    }

    public function test_niezarejestrowany_brak_dostepu_do_statystyki_przekierowanie_login()
    {
        $response = $this->get('/statystyki');

        $response->assertStatus(302);
        $response->assertRedirect('login');
    }

    public function test_niezarejestrowany_brak_dostepu_do_ulubione_przekierowanie_login()
    {
        $response = $this->get('/ulubione');

        $response->assertStatus(302);
        $response->assertRedirect('login');
    }

    public function test_niezarejestrowany_brak_dostepu_do_zgloszenia_przekierowanie_login()
    {
        $response = $this->get('/zgloszenia');

        $response->assertStatus(302);
        $response->assertRedirect('login');
    }
}
