<?php

namespace App\Http\Controllers;

use App\Models\Konwersacje;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use \Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Wiadomosci;


class KonwersacjeController extends Controller
{
  /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index() : View
    {
        $count = 1;
        $wiadomosc = null;



        $konwersacje = DB::table('konwersacje')
        ->select()
        ->addSelect(DB::raw('nadawca.name as nadawca'))
        ->join('konwersacje_wiadomosci', 'konwersacje.id', '=', 'konwersacje_wiadomosci.konwersacje_id')
        ->join('wiadomosci', 'wiadomosci.id', '=', 'konwersacje_wiadomosci.wiadomosci_id')
        ->join('users as wiadomosci_user', 'wiadomosci_user.id', '=', 'wiadomosci.user_id')
        ->join('users as nadawca', 'nadawca.id', '=', 'konwersacje.nadawca_id') 
        ->where('konwersacje.odbiorca_id', '=', Auth::user()->id)
        ->orWhere('konwersacje.nadawca_id', '=', Auth::user()->id)
        ->groupBy('konwersacje.id')
        ->get();


       if(!is_null($konwersacje)){



        $wiadomosci = DB::table('wiadomosci')
         ->select()
         ->addSelect(DB::raw('wiadomosci_user.name as autor_wiadomosci'))
         ->addSelect(DB::raw('odbiorca.name as odbiorca_name'))
         ->addSelect(DB::raw('odbiorca.surname as odbiorca_surname'))
         ->addSelect(DB::raw('odbiorca.email as odbiorca_email'))
        ->join('konwersacje_wiadomosci', 'wiadomosci.id', '=', 'konwersacje_wiadomosci.wiadomosci_id')
        ->leftjoin('users as wiadomosci_user', 'wiadomosci_user.id', '=', 'wiadomosci.user_id')
        ->join('konwersacje', 'konwersacje.id', '=', 'konwersacje_wiadomosci.konwersacje_id')
        ->leftjoin('users as odbiorca', 'odbiorca.id', '=', 'konwersacje.odbiorca_id')
        ->leftjoin('users as nadawca', 'nadawca.id', '=', 'konwersacje.nadawca_id')
        ->where('konwersacje.odbiorca_id', '=', Auth::user()->id)
        ->orWhere('konwersacje.nadawca_id', '=', Auth::user()->id)  
        ->orderBy('wiadomosci.created_at', 'desc')  
        ->orderBy('konwersacje.id', 'desc')  
        ->get() ;

       

        // kod (linie 71-81) wychwytuje ostatnie wiadomości dla każdej konwersacji.   

        $exist[] = 0;
        $test[] = null;

        foreach ($wiadomosci as $x) {
            if(!in_array($x->konwersacje_id,$exist)){
                    array_push($test, $x);
                    array_push($exist, $x->konwersacje_id);
            }
        }

        // unset usuwa pierwszy pusty obiekt powstający w czasie tworzenia listy $test[]

        unset($test[0]);
       

      
     
       }
       

      

        return view('konwersacje.index',[
            'konwersacje' => $test,
            'count' => $count,
           
         
        ]);
    }

  /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create() : View
    {
        return view('konwersacje.create');
    }

   /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {

        $validated = $request->validate([
            'email' => 'required|email|string|exists:users|max:255',
            'temat' => 'required|string|max:255',
            'wiadomosc' => 'required|string|max:1500',
        ]);


        $odbiorca = User::where('email', $request->email)->first();

       

        $konwersacje = new Konwersacje($request->all());
        $konwersacje->nadawca_id = Auth::user()->id; 
        $konwersacje->odbiorca_id = $odbiorca->id;
        $konwersacje->save();

        $wiadomosci = new Wiadomosci();
        $wiadomosci->wiadomosc = $request->wiadomosc;
        $wiadomosci->user_id = Auth::user()->id; 
        $wiadomosci->save();

        $konwersacje->wiadomosci()->attach($wiadomosci);


     
        return redirect(route('konwersacje.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Konwersacje  $konwersacje
     * @return \Illuminate\Http\Response
     */
    public function show(Konwersacje $konwersacje)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Konwersacje  $konwersacje
     * @return \Illuminate\Http\Response
     */
    public function edit(Konwersacje $konwersacje)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Konwersacje  $konwersacje
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Konwersacje $konwersacje)
    {
        //
    }

  
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Nieruchomosci  $nieruchomosci
     * @return JsonResponse
     */
    public function destroy(Konwersacje $id) : JsonResponse
    {
       
       
       $id->delete();
          
            
            return response()->json([
                'da' => $id
                
            ]);
       
    }

    public function podgladKonwersacji(Konwersacje $id)
    {


        $konwersacja = $id->id;

        $temat = Konwersacje::where('id', $konwersacja)->first()->temat;

        $wiadomosci = DB::table('wiadomosci')
        ->select()
        ->addSelect(DB::raw('wiadomosci.created_at as wiadomosci_created_at'))
        ->join('konwersacje_wiadomosci', 'wiadomosci.id', '=', 'konwersacje_wiadomosci.wiadomosci_id')
        ->join('users', 'users.id', '=', 'wiadomosci.user_id')
        ->where('konwersacje_id', '=', $id->id)
        ->get();

       
   

             
      
return view('konwersacje.podglad',[
    'konwersacja' => $id,
    'wiadomosci' => $wiadomosci,
    'temat' => $temat,
   
]);
    }

      /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse
     */
    public function zapiszWiadomosc(Request $request): RedirectResponse
    {

        $wiadomosci = new Wiadomosci();
        $wiadomosci->wiadomosc = $request->wiadomosc;
        $wiadomosci->user_id = Auth::user()->id; 
        $wiadomosci->save();

        $konwersacje = Konwersacje::findOrFail($request->konwersacja_id);

        $konwersacje->wiadomosci()->attach($wiadomosci);


        return redirect(route('konwersacje.podgladKonwersacji', ['id' => $request->konwersacja_id]));
    }

    public function createWiadomosc(User $id) : View
    {
        $email = $id->email;

  

    return view('konwersacje.createWiadomosc',[
        'email' => $email,
        
    ]);
       
    }

    
}

