<?php

namespace App\Http\Controllers;

use App\Models\Statystyki;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use \Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use App\Models\User;
use App\Models\Nieruchomosci;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class StatystykiController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index() : View
    {
        $count = 1;
        $statystyki = DB::table('nieruchomosci')
                ->join('statystyki', 'nieruchomosci.id', '=', 'statystyki.nieruchomosci_id')
                ->where('statystyki.users_id', '=', Auth::user()->id)
                ->get();
           

        return view('statystyki.index',[
            'statystyki' => $statystyki,
            'count' => $count
        ]);
    }
     /**
     * Show the form for creating a new resource.
     *
     * @return \View
     */
    public function create(): View
    {
        
        $nieruchomosci = DB::table('nieruchomosci')
        ->where('users_id', '=', Auth::user()->id)
        ->get();


        return view('statystyki.create',[
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
        $statystyki = new Statystyki($request->all());
        $statystyki->users_id = Auth::user()->id; 
        $statystyki->save();

        return redirect(route('statystyki.index'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Monitor  $monitor
     * @return JsonResponse
     */
    public function destroy(Statystyki $id) : JsonResponse
    {
       
       
       $id->delete();
          
            
            return response()->json([
                'da' => $id
                
            ]);
       
    }
}
