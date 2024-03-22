<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcomeHome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/nieruchomosci', [App\Http\Controllers\NieruchomosciController::class, 'index'])->name('nieruchomosci.index')->middleware('can:isWlasciciel');
Route::get('/nieruchomosci/dodajNieruchomosc', [App\Http\Controllers\NieruchomosciController::class, 'create'])->name('nieruchomosci.create')->middleware('can:isWlasciciel');
Route::post('/nieruchomosci', [App\Http\Controllers\NieruchomosciController::class, 'store'])->name('nieruchomosci.store')->middleware('can:isWlasciciel');
Route::get('/nieruchomosci/{id}/edit', [App\Http\Controllers\NieruchomosciController::class, 'edit'])->name('nieruchomosci.edit')->middleware('can:isWlasciciel');
Route::post('/nieruchomosci/{id}', [App\Http\Controllers\NieruchomosciController::class, 'update'])->name('nieruchomosci.update')->middleware('can:isWlasciciel');
Route::delete('/nieruchomosci/usun/{id}', [App\Http\Controllers\NieruchomosciController::class, 'destroy'])->name('nieruchomosci.destroy')->middleware('can:isWlasciciel');
Route::get('/nieruchomosci/{id}/dodajWynajmujacego', [App\Http\Controllers\NieruchomosciController::class, 'dodajWynajmujacego'])->name('nieruchomosci.dodajWynajmujacego')->middleware('can:isWlasciciel');
Route::post('/nieruchomosci/{id}/zapiszWynajmujacego', [App\Http\Controllers\NieruchomosciController::class, 'zapiszWynajmujacego'])->name('nieruchomosci.zapiszWynajmujacego')->middleware('can:isWlasciciel');
Route::delete('/nieruchomosci/{id}', [App\Http\Controllers\NieruchomosciController::class, 'usunWynajmujacego'])->name('nieruchomosci.usunWynajmujacego')->middleware('can:isWlasciciel');

Route::get('/dokumenty', [App\Http\Controllers\DokumentyController::class, 'index'])->name('dokumenty.index')->middleware('auth');
Route::get('/dokumenty/dodajDokument', [App\Http\Controllers\DokumentyController::class, 'create'])->name('dokumenty.create')->middleware('auth');
Route::post('/dokumenty', [App\Http\Controllers\DokumentyController::class, 'store'])->name('dokumenty.store')->middleware('auth');
Route::get('/dokumenty/{id}/download', [App\Http\Controllers\DokumentyController::class, 'fileDownload'])->name('dokumenty.fileDownload')->middleware('auth');
Route::delete('/dokumenty/{id}', [App\Http\Controllers\DokumentyController::class, 'destroy'])->name('dokumenty.destroy')->middleware('auth');

Route::get('/ogloszenia', [App\Http\Controllers\OgloszeniaController::class, 'index'])->name('ogloszenia.index')->middleware('auth');
Route::get('/ogloszenia/dodajOgloszenie', [App\Http\Controllers\OgloszeniaController::class, 'create'])->name('ogloszenia.create')->middleware('auth');
Route::post('/ogloszenia', [App\Http\Controllers\OgloszeniaController::class, 'store'])->name('ogloszenia.store')->middleware('auth');
Route::delete('/ogloszenia/{id}', [App\Http\Controllers\OgloszeniaController::class, 'destroy'])->name('ogloszenia.destroy')->middleware('auth');
Route::get('/ogloszenia/{id}/podgladOgloszenia', [App\Http\Controllers\OgloszeniaController::class, 'podgladOgloszenia'])->name('ogloszenia.podgladOgloszenia')->middleware('auth');
Route::post('/ogloszenia/{id}/dodajUlubione', [App\Http\Controllers\OgloszeniaController::class, 'dodajUlubione'])->name('ogloszenia.dodajUlubione')->middleware('auth');
Route::get('/wszystkieOgloszenia', [App\Http\Controllers\OgloszeniaController::class, 'wszystkieOgloszenia'])->name('ogloszenia.wszystkieOgloszenia')->middleware('auth');
Route::post('/ogloszenia/{id}/rezerwacja', [App\Http\Controllers\OgloszeniaController::class, 'rezerwacja'])->name('ogloszenia.rezerwacja')->middleware('auth');
Route::post('/ogloszenia/{id}/anulujRezerwacje', [App\Http\Controllers\OgloszeniaController::class, 'anulujRezerwacje'])->name('ogloszenia.anulujRezerwacje')->middleware('auth');
Route::get('/ogloszenia/{id}/edit', [App\Http\Controllers\OgloszeniaController::class, 'edit'])->name('ogloszenia.edit')->middleware('can:isWlasciciel');
Route::post('/ogloszenia/{id}', [App\Http\Controllers\OgloszeniaController::class, 'update'])->name('ogloszenia.update')->middleware('can:isWlasciciel');

Route::get('/ulubione', [App\Http\Controllers\UlubioneController::class, 'index'])->name('ulubione.index')->middleware('auth');
Route::delete('/ulubione/{id}', [App\Http\Controllers\UlubioneController::class, 'destroy'])->name('ulubione.destroy')->middleware('auth');

Route::get('/zgloszenia', [App\Http\Controllers\ZgloszeniaController::class, 'index'])->name('zgloszenia.index')->middleware('auth');
Route::get('/zgloszenia/dodajZgloszenie', [App\Http\Controllers\ZgloszeniaController::class, 'create'])->name('zgloszenia.create')->middleware('can:isWynajmujacy');
Route::post('/zgloszenia', [App\Http\Controllers\ZgloszeniaController::class, 'store'])->name('zgloszenia.store')->middleware('auth');
Route::delete('/zgloszenia/{id}', [App\Http\Controllers\ZgloszeniaController::class, 'destroy'])->name('zgloszenia.destroy')->middleware('auth');
Route::get('/zgloszeniaWlasciciel', [App\Http\Controllers\ZgloszeniaController::class, 'zgloszeniaWlasciciel'])->name('zgloszenia.zgloszeniaWlasciciel')->middleware('auth');
Route::get('/zgloszenia/{id}/zmienStatus', [App\Http\Controllers\ZgloszeniaController::class, 'zmienStatus'])->name('zgloszenia.zmienStatus')->middleware('can:isWlasciciel');
Route::post('/zgloszenia/zapiszStatus', [App\Http\Controllers\ZgloszeniaController::class, 'zapiszStatus'])->name('zgloszenia.zapiszStatus')->middleware('can:isWlasciciel');

Route::get('/konwersacje', [App\Http\Controllers\KonwersacjeController::class, 'index'])->name('konwersacje.index')->middleware('auth');
Route::get('/konwersacje/stworzKonwersacje', [App\Http\Controllers\KonwersacjeController::class, 'create'])->name('konwersacje.create')->middleware('auth');
Route::post('/konwersacje', [App\Http\Controllers\KonwersacjeController::class, 'store'])->name('konwersacje.store')->middleware('auth');
Route::get('/konwersacje/{id}/podgladKonwersacji', [App\Http\Controllers\KonwersacjeController::class, 'podgladKonwersacji'])->name('konwersacje.podgladKonwersacji')->middleware('auth');
Route::post('/konwersacje/zapiszWiadomosc', [App\Http\Controllers\KonwersacjeController::class, 'zapiszWiadomosc'])->name('konwersacje.zapiszWiadomosc')->middleware('auth');
Route::get('/konwersacje/{id}/napiszWiadomosc', [App\Http\Controllers\KonwersacjeController::class, 'createWiadomosc'])->name('konwersacje.createWiadomosc')->middleware('auth');
Route::delete('/konwersacje/{id}', [App\Http\Controllers\KonwersacjeController::class, 'destroy'])->name('konwersacje.destroy')->middleware('auth');



Route::get('/monitor', [App\Http\Controllers\MonitorController::class, 'index'])->name('monitor.index')->middleware('auth');
Route::get('/monitor/wykresy', [App\Http\Controllers\MonitorController::class, 'wykresy'])->name('monitor.wykresy')->middleware('auth');
Route::get('/monitor/dodajZuzycie', [App\Http\Controllers\MonitorController::class, 'create'])->name('monitor.create')->middleware('auth');
Route::post('/moniotr', [App\Http\Controllers\MonitorController::class, 'store'])->name('monitor.store')->middleware('auth');
Route::delete('/monitor/{id}', [App\Http\Controllers\MonitorController::class, 'destroy'])->name('monitor.destroy')->middleware('auth');
Route::get('/monitorWlasciciel', [App\Http\Controllers\MonitorController::class, 'monitorWlasciciel'])->name('monitor.monitorWlasciciel')->middleware('auth');

Route::get('/statystyki', [App\Http\Controllers\StatystykiController::class, 'index'])->name('statystyki.index')->middleware('auth');
Route::get('/statystyki/dodajStatystyke', [App\Http\Controllers\StatystykiController::class, 'create'])->name('statystyki.create')->middleware('auth');
Route::post('/statystyki', [App\Http\Controllers\StatystykiController::class, 'store'])->name('statystyki.store')->middleware('auth');
Route::delete('/statystyki/{id}', [App\Http\Controllers\StatystykiController::class, 'destroy'])->name('statystyki.destroy')->middleware('auth');