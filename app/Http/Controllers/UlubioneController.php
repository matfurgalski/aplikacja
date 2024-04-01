<?php

namespace App\Http\Controllers;

use App\Models\Ulubione;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use \Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UlubioneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index() : View
    {
        $count = 1;
        $ulubione = DB::table('ulubione')
                ->join('ogloszenia', 'ulubione.ogloszenia_id', '=', 'ogloszenia.id')
                ->join('nieruchomosci', 'ogloszenia.nieruchomosci_id', '=', 'nieruchomosci.id')
                ->where('ulubione.users_id', '=', Auth::user()->id)
                ->get();
            
         $id = DB::table('ulubione')
            ->where('users_id', '=', Auth::user()->id) 
            ->value('id');
            

        return view('ulubione.index',[
            'ulubione' => $ulubione,
            'count' => $count,
            'id' => $id
        ]);
    }

   /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ulubione  $ulubione
     * @return JsonResponse
     */
    public function destroy(Ulubione $id) : JsonResponse
    {
       
        echo "<pre>";
        print_r($id);
        echo "</pre>";

      //  Ulubione::find($id)->delete();
      $id->delete();
      
          
            
            return response()->json([
                'da' => $id
                
            ]);
       
    }
}
