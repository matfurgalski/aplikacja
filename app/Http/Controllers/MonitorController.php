<?php

namespace App\Http\Controllers;

use App\Models\Monitor;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use \Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use App\Models\User;
use App\Models\Nieruchomosci;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MonitorController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $count = 1;

        $monitor = DB::table('nieruchomosci')
        ->join('monitor', 'monitor.nieruchomosc_id', '=', 'nieruchomosci.id')
        ->where('user_id', '=', Auth::user()->id)
        ->get();

        return view('monitor.index',[
            'monitor' => $monitor,
            'count' => $count  
        ]);
    }

         /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function monitorWlasciciel(): View
    {
        $count = 1;


        $monitor = DB::table('nieruchomosci')
        ->join('monitor', 'monitor.nieruchomosc_id', '=', 'nieruchomosci.id')
        ->where('users_id', '=', Auth::user()->id)
        ->get();

        return view('monitor.index',[
            'monitor' => $monitor,
            'count' => $count
        ]);
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        if (Nieruchomosci::where('wynajmujacy_id', '=', Auth::user()->id) ->exists()) {
            return view("monitor.create");
        }else{

            return redirect()->back()->with('alert','Aktualnie nie wynajmujesz żadnej nieruchomości');
        }
        
        return view("monitor.create");
    }

  /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        
       
         

        $monitor = new Monitor($request->all());
        $monitor->user_id = Auth::user()->id;
        $monitor->nieruchomosc_id = DB::table('nieruchomosci')->select('id')->where('wynajmujacy_id', Auth::user()->id)->first()->id;
        $monitor->save();

        
        return redirect(route('monitor.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Monitor  $monitor
     * @return \Illuminate\Http\Response
     */
    public function show(Monitor $monitor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Monitor  $monitor
     * @return \Illuminate\Http\Response
     */
    public function edit(Monitor $monitor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Monitor  $monitor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Monitor $monitor)
    {
        //
    }

   /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Monitor  $monitor
     * @return JsonResponse
     */
    public function destroy(Monitor $id) : JsonResponse
    {
       
       
       $id->delete();
          
            
            return response()->json([
                'da' => $id
                
            ]);
       
    }
}
