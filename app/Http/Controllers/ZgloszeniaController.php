<?php

namespace App\Http\Controllers;

use App\Models\Zgloszenia;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use \Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Nieruchomosci;
use Illuminate\Support\Facades\Redirect;

class ZgloszeniaController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $count = 1;
      

        $zgloszenia = DB::table('nieruchomosci')
        ->select()
        ->addSelect(DB::raw('zgloszenia.id as zgloszenia_id'))
        ->addSelect(DB::raw('zgloszenia.created_at as zgloszenia_created_at'))
        ->join('zgloszenia', 'nieruchomosci.id', '=', 'zgloszenia.nieruchomosci_id')
        ->join('users', 'users.id', '=', 'zgloszenia.users_id')
        ->where('zgloszenia.users_id', '=', Auth::user()->id)
        ->get();

       
        return view('zgloszenia.index',[
            'zgloszenia' => $zgloszenia,
            'count' => $count 
        ]);
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \View
     */
    public function create()
    {
        $nieruchomosci = Nieruchomosci::where('wynajmujacy_id', '=', Auth::user()->id)->first();

    

        if($nieruchomosci == null){
        return Redirect::back()->withErrors(['msg' => 'Nie wynajmujesz żadnej nieruchomości, skontaktuj się z właścicielem']);
        }
        else
        return view("zgloszenia.create");

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
       
         $id = Nieruchomosci::where('wynajmujacy_id', Auth::user()->id)->first();
      
    
        $zgloszenia = new Zgloszenia($request->all());
     
         $zgloszenia->users_id = Auth::user()->id;
         $zgloszenia->nieruchomosci_id=$id->id;
        $zgloszenia->status='oczekujace';

        $zgloszenia->save();
        return redirect(route('zgloszenia.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Zgloszenia  $zgloszenia
     * @return \Illuminate\Http\Response
     */
    public function show(Zgloszenia $zgloszenia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Zgloszenia  $zgloszenia
     * @return \Illuminate\Http\Response
     */
    public function edit(Zgloszenia $zgloszenia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Zgloszenia  $zgloszenia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Zgloszenia $zgloszenia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Zgloszenia  $zgloszenia
     * @return JsonResponse
     */
    public function destroy(Zgloszenia $id) : JsonResponse
    {

      $id->delete();
              
            return response()->json([
                'da' => $id
                
            ]);
       
    }

       /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function zgloszeniaWlasciciel(): View
    {
        $count = 1;
        $zgloszenia = DB::table('nieruchomosci')
        ->select()
        ->addSelect(DB::raw('zgloszenia.id as zgloszenia_id'))
        ->addSelect(DB::raw('zgloszenia.created_at as zgloszenia_created_at'))
        ->join('zgloszenia', 'nieruchomosci.id', '=', 'zgloszenia.nieruchomosci_id')
        ->join('users', 'users.id', '=', 'zgloszenia.users_id')
        ->where('nieruchomosci.users_id', '=', Auth::user()->id)
        ->orderBy('status', 'ASC')
        ->orderBy('typ_zgloszenia', 'ASC')
        ->get();

        return view('zgloszenia.index',[
            'zgloszenia' => $zgloszenia,
            'count' => $count
        ]);
    }

     
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Zgloszenia  $zgloszenia
     * @return \Illuminate\Http\Response
     */
    public function zmienStatus(Zgloszenia $id): View
    {

        return view('zgloszenia.zmienStatus',[
            'zgloszenia' => $id
        ]);
    }

       
    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function zapiszStatus(Request $request, Zgloszenia $id): RedirectResponse
    {

        $zgloszenia_id = $request->input('zgloszenia_id');
   
         $zgloszenia = Zgloszenia::where('id', $zgloszenia_id)->first();
   
         $zgloszenia->status = $request->input('status');
         $zgloszenia->save();
   
        return redirect(route('zgloszenia.zgloszeniaWlasciciel'));
        
    }

}
