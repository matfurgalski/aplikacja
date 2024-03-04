<?php

namespace App\Http\Controllers;

use App\Models\Nieruchomosci;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use \Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

         /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        if(Auth::user()->role == 'wlasciciel'){

        $sumaWydatki = 0;
        $sumaPrzychody = 0;

        $liczbaNieruchomosci = DB::table('nieruchomosci')
        ->where('users_id', '=', Auth::user()->id)
        ->count();

        $liczbaOgloszen = DB::table('ogloszenia')
        ->where('wlasciciel_id', '=', Auth::user()->id)
        ->count();

        $oczekujaceZadania = DB::table('nieruchomosci')
        ->join('zgloszenia', 'nieruchomosci.id', '=', 'zgloszenia.nieruchomosci_id')
        ->join('users', 'users.id', '=', 'zgloszenia.users_id')
        ->where('nieruchomosci.users_id', '=', Auth::user()->id)
        ->Where('status', 'oczekujace')
        ->count();

        $wydatki = DB::table('statystyki')
        ->where('users_id', '=', Auth::user()->id)
        ->Where('rodzaj', 'wydatek')
        ->get();

        foreach ($wydatki as $x){
            $sumaWydatki =$sumaWydatki + $x->kwota;
        }

        $przychody = DB::table('statystyki')
        ->where('users_id', '=', Auth::user()->id)
        ->Where('rodzaj', 'przychod')
        ->get();

        foreach ($przychody as $x){
            $sumaPrzychody =$sumaPrzychody + $x->kwota;
        }

        return view('home',[
            'liczbaNieruchomosci' => $liczbaNieruchomosci,
            'oczekujaceZadania' =>  $oczekujaceZadania,
            'sumaWydatki' =>  $sumaWydatki,
            'sumaPrzychody' =>  $sumaPrzychody,
            'liczbaOgloszen' => $liczbaOgloszen
        ]);
    }else{
        return redirect(route('ogloszenia.wszystkieOgloszenia'));
    }
    }
}
