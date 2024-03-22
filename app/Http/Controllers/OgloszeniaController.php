<?php

namespace App\Http\Controllers;

use App\Models\Ogloszenia;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use \Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Zdjecia;
use App\Models\Ulubione;

class OgloszeniaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index() : View
    {
        $count = 1;
        $ogloszenia = DB::table('nieruchomosci')
                ->join('ogloszenia', 'nieruchomosci.id', '=', 'ogloszenia.nieruchomosci_id')
                ->where('wlasciciel_id', '=', Auth::user()->id)
                ->get();
           

        return view('ogloszenia.index',[
            'ogloszenia' => $ogloszenia,
            'count' => $count
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create() : View
    {
        $nieruchomosci = DB::table('nieruchomosci')
        ->where('users_id', '=', Auth::user()->id)
        ->get();


        return view('ogloszenia.create',[
            'nieruchomosci' => $nieruchomosci
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $ogloszenia = new Ogloszenia($request->all());
        $ogloszenia->wlasciciel_id = Auth::user()->id; 
        $ogloszenia->save();

        
        if(!empty($request->file('plik'))){
       foreach($request->file('plik') as $key => $file){
            $zdjecia = new Zdjecia();
            $zdjecia->file_path = $file->store('zdjecia','public');       
            $zdjecia->save();
            $ogloszenia->zdjecia()->attach($zdjecia);
       }}else{}

    

        return redirect(route('ogloszenia.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ogloszenia  $ogloszenia
     * @return \Illuminate\Http\Response
     */
    public function show(Ogloszenia $ogloszenia)
    {
        //
    }

       /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ogloszenia  $nieruchomosci
     * @return \Illuminate\Http\Response
     */
    public function edit(Ogloszenia $id)
    {
        $nieruchomosci = DB::table('nieruchomosci')
        ->where('users_id', '=', Auth::user()->id)
        ->get();

        $ogloszenia = DB::table('nieruchomosci')
        ->join('ogloszenia', 'nieruchomosci.id', '=', 'ogloszenia.nieruchomosci_id')
        ->where('ogloszenia.id', '=', $id->id)
        ->first();

        $zdjecia = DB::table('zdjecia')
        ->join('ogloszenia_zdjecia', 'zdjecia.id', '=', 'ogloszenia_zdjecia.zdjecia_id')
        ->where('ogloszenia_id', '=', $id->id)
        ->get();


        echo "<pre>";
        print_r($zdjecia);
        echo "</pre>";
        return view('ogloszenia.edit',[
            'ogloszenia' => $ogloszenia,
            'nieruchomosci' => $nieruchomosci,
            'zdjecia' => $zdjecia,
        ]);
    }

       /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ogloszenia  $ogloszenia
     * @return \Illuminate\Http\Response
     * 
     */
    public function update(Request $request, Ogloszenia $id): RedirectResponse
    {
     

       $id->fill($request->all());
 
       $id->save();

       if(!empty($request->file('plik'))){

        $zdjecia = DB::table('zdjecia')
        ->join('ogloszenia_zdjecia', 'zdjecia.id', '=', 'ogloszenia_zdjecia.zdjecia_id')
        ->where('ogloszenia_id', '=', $id->id)
        ->get();

        foreach($zdjecia as $zdjecia){
            if(Storage::disk('public')->exists($zdjecia->file_path)){
                Storage::disk('public')->delete($zdjecia->file_path);   
                 }
            
                }
                
                $id->zdjecia()->delete();

        foreach($request->file('plik') as $key => $file){
             $zdjecia = new Zdjecia();
             $zdjecia->file_path = $file->store('zdjecia','public');       
             $zdjecia->save();
             $id->zdjecia()->attach($zdjecia);
        }}else{}

       return redirect(route('ogloszenia.index'));

    }

    /**
   

     * @param  \App\Models\Ogloszenia  $id
     * @return \Illuminate\Http\Response
     */
    public function rezerwacja(Ogloszenia $id)
    {
      $id->rezerwacja_id = Auth::user()->id; 
      $id->save();
    }

        /**
   

     * @param  \App\Models\Ogloszenia  $id
     * @return \Illuminate\Http\Response
     */
    public function anulujRezerwacje(Ogloszenia $id)
    {
      $id->rezerwacja_id = null; 
      $id->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ogloszenia  $ogloszenia
     * @return JsonResponse
     */
    public function destroy(Ogloszenia $id) : JsonResponse
    {
        $ogloszenia = DB::table('zdjecia')
        ->join('ogloszenia_zdjecia', 'zdjecia.id', '=', 'ogloszenia_zdjecia.zdjecia_id')
        ->where('ogloszenia_id', '=', $id->id)
        ->get();




        foreach($ogloszenia as $zdjecia){
        if(Storage::disk('public')->exists($zdjecia->file_path)){
            Storage::disk('public')->delete($zdjecia->file_path);   
             }
        
            }
            

       
            $id->zdjecia()->delete();
            $id->delete();
           
             return response()->json([
                 'da' => $ogloszenia
                 
             ]);
    }

    public function podgladOgloszenia(Ogloszenia $id)
    {
        $ogloszenia = DB::table('nieruchomosci')
                ->join('ogloszenia', 'nieruchomosci.id', '=', 'ogloszenia.nieruchomosci_id')
                ->where('ogloszenia.id', '=', $id->id)
                ->get();

                $zdjecia = DB::table('zdjecia')
                ->join('ogloszenia_zdjecia', 'zdjecia.id', '=', 'ogloszenia_zdjecia.zdjecia_id')
                ->where('ogloszenia_id', '=', $id->id)
                ->get();
 

        $user = DB::table('users')
            ->where('id', '=', $id->rezerwacja_id)
            ->get();
      
        return view('ogloszenia.podglad',[
            'ogloszenia' => $ogloszenia,
            'zdjecia' => $zdjecia,
            'user' => $user
        ]);
    }

    public function wszystkieOgloszenia() : View
    {
        
        $ogloszenia = DB::table('nieruchomosci')
                ->join('ogloszenia', 'nieruchomosci.id', '=', 'ogloszenia.nieruchomosci_id')   
                ->get();


                $zdjecia = DB::table('zdjecia')
                ->join('ogloszenia_zdjecia', 'zdjecia.id', '=', 'ogloszenia_zdjecia.zdjecia_id')
                ->get();
     

        return view('ogloszenia.wszystkieOgloszenia',[
            'ogloszenia' => $ogloszenia,
            'zdjecia' => $zdjecia
        ]);
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ogloszenia  $ogloszenia
     * @return JsonResponse
     */
    public function dodajUlubione(Ogloszenia $id) : JsonResponse
    {

        $ulubione = new Ulubione();
        $ulubione->users_id = Auth::user()->id; 
        $ulubione->ogloszenia_id = $id->id; 
        $ulubione->save();

             return response()->json([
                 'da' => $id
                 
             ]);
    }
}
