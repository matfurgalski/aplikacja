<?php

namespace App\Http\Controllers;

use App\Models\Dokumenty;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DokumentyController extends Controller
{
       /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $count = 1;
        $dokumenty = DB::table('dokumenty')
        ->where('users_id', '=', Auth::user()->id)
        ->get();

        return view('dokumenty.index',[
            'dokumenty' => $dokumenty,
            'count' => $count
        ]);
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view("dokumenty.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
      //  $storage = new Dokumenty($request->all());
        
        // $storage->users_id = Auth::user()->id;
        // $storage->file_path =  Storage::putFile('dokumenty', $request->file('plik')); 
        // ddd($request->file('plik'));   
                                                         
        // $storage->save();
   
 
 
        $storage = new Dokumenty([
            'nazwa' => $request->nazwa,
            'users_id' =>Auth::user()->id,
            'file_path' => $request->file('plik')->store('dokumenty')
        ]);

   
        $storage->save();


        return redirect(route('dokumenty.index'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dokumenty  $dokumenty
     * @return JsonResponse
     */
    public function destroy(Dokumenty $id): JsonResponse
    {
        if(Storage::exists($id->file_path)){
           Storage::delete($id->file_path);
           $id->delete();    
            }

            return response()->json([
                'da' => $id
                
            ]);
   

    }
   /**
     * Display the specified resource.
     *
     * @param  Dokumenty $dokumenty
     * @return RedirectResponse|StreamedResponse
     */

    public function fileDownload(Dokumenty $id): RedirectResponse|StreamedResponse
    {
        if(Storage::exists($id->file_path)){
        return Storage::download($id->file_path);
      
        }

      
       return Redirect::back();
    }
}
