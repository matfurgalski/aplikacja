<?php

namespace App\Http\Controllers;

use App\Models\Nieruchomosci;
use Illuminate\Http\Request;
use \Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;





class NieruchomosciController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $count = 1;
        $nieruchomosci = DB::table('nieruchomosci')
                ->select()
                ->addSelect(DB::raw('nieruchomosci.id as nieruchomosci_id'))
                ->leftjoin('users', 'users.id', '=', 'nieruchomosci.wynajmujacy_id')
                ->where('nieruchomosci.users_id', '=', Auth::user()->id)           
                ->get();


        return view('nieruchomosci.index',[
            'nieruchomosci' => $nieruchomosci,
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
        
        return view("nieruchomosci.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
     

        $nieruchomosci = new Nieruchomosci($request->all());
        $nieruchomosci->users_id = Auth::user()->id;
        $nieruchomosci->save();
        return redirect(route('nieruchomosci.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Nieruchomosci  $nieruchomosci
     * @return \Illuminate\Http\Response
     */
    public function show(Nieruchomosci $nieruchomosci)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Nieruchomosci  $nieruchomosci
     * @return \Illuminate\Http\Response
     */
    public function edit(Nieruchomosci $id)
    {
       
        return view('nieruchomosci.edit',[
            'nieruchomosci' => $id
           
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Nieruchomosci  $nieruchomosci
     * @return \Illuminate\Http\Response
     * 
     */
    public function update(Request $request, Nieruchomosci $id): RedirectResponse
    {
     

       $id->fill($request->all());
 
       $id->save();

       return redirect(route('nieruchomosci.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Nieruchomosci  $nieruchomosci
     * @return JsonResponse
     */
    public function destroy(Nieruchomosci $id) : JsonResponse
    {
       

       $id->delete();
          
       
            return response()->json([
                'da' => $id
                
            ]);
       
    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Nieruchomosci  $nieruchomosci
     * @return \Illuminate\Http\Response
     */
    public function dodajWynajmujacego(Nieruchomosci $id): View
    {

        return view('nieruchomosci.dodajWynajmujacego',[
            'nieruchomosci' => $id
        ]);
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function zapiszWynajmujacego(Request $request, Nieruchomosci $id): RedirectResponse
    {

        //$mail = $request->input('wynajmujacy_mail');

        $validated = $request->validate([
            'email' => 'required|email|string|exists:users|max:255',
        ]);

      

        $nieruchomosc_id = $request->input('nieruchomosc_id');



        $user_id = User::where('email', $request->email)->first();

        $nieruchomosc = Nieruchomosci::where('id', $nieruchomosc_id)->first();

       
       
        $nieruchomosc->wynajmujacy_id = $user_id->id;
        $nieruchomosc->save();

      
  
      
        return redirect(route('nieruchomosci.index'));
        
    }

    public function usunWynajmujacego(Nieruchomosci $id) : JsonResponse
    {
       
       
       $id->wynajmujacy_id = null;
       $id->save();
            
            return response()->json([
                'da' => $id
                
            ]);
       
    }
}
