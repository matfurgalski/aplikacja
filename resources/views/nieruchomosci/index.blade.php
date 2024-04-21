@extends('layouts.app1')

@section('content')



  
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Wszystkie Nieruchomości</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <a type="button" href="/nieruchomosci/dodajNieruchomosc" class="btn btn-sm btn-outline-secondary">Dodaj nieruchomość +</a>
            
          </div>
       
        </div>
      </div>

      <div class="conteiner">
  <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nazwa</th>
      <th scope="col">Notatki</th>
      <th scope="col">Powierzchnia</th>
      <th scope="col">Liczba pokoi</th>
      <th scope="col">Ulica</th>
      <th scope="col">Kod pocztowy</th>
      <th scope="col">Miasto</th>
      <th scope="col">Wynajmujący</th>
      <th scope="col">Akcje</th>



    </tr>
  </thead>
  <tbody>
    @forelse($nieruchomosci as $nieruchomosc)
    <tr>
      <th scope="row">{{$count++}}</th>
      <td>{{$nieruchomosc->nazwa}}</td>
      <td>{!!nl2br($nieruchomosc->opis)!!}</td>
      <td>{{$nieruchomosc->powierzchnia}} m/3</td>
      <td>{{$nieruchomosc->liczba_pokoi}}</td>
      <td>{{$nieruchomosc->ulica}}</td>
      <td>{{$nieruchomosc->kod_pocztowy}}</td>
      <td>{{$nieruchomosc->miasto}}</td>
      <td>{{$nieruchomosc->name}} {{$nieruchomosc->surname}} - {{$nieruchomosc->email}} </td>
      <td>

     
        <button id="button-id" class="btn btn-danger btn-sm delete" data-id="{{$nieruchomosc->nieruchomosci_id}}"> <svg class="bi" width="18" height="18"><use xlink:href="#trash"/></svg></button>

        
        <a href=" {{route('nieruchomosci.dodajWynajmujacego', $nieruchomosc->nieruchomosci_id)}}"class="btn btn-primary btn-sm "> 
        <button id="button-wpisz-wynajmujacego" class="btn btn-primary btn-sm " > Wpisz wynajmujacego </button>
      </a>
   
      <a class="btn btn-warning btn-sm " >
      <button class="btn btn-warning btn-sm usunWynajmujacego" data-id="{{$nieruchomosc->nieruchomosci_id}}" ></i> Usuń wynajmujacego </button>
</a>
<a href=" {{route('nieruchomosci.edit', $nieruchomosc->nieruchomosci_id)}}"class="btn btn-success btn-sm "> 
        <button class="btn btn-success btn-sm " ></i> Edytuj nieruchomość </button>
      </a>
        

      </td>
    </tr>
    @empty
    <tr>
      <th scope="row"></th>
      <td>{{__('Nie znaleziono nieruchomości')}}</td>
    </tr>
    @endforelse
  </tbody>
</table>
</div>

   
 
@endsection
@section('javascript')

    $(function(){
 

        $(".delete").click(function(){
    var id = $(this).data("id");
    var token = $("meta[name='csrf-token']").attr("content");

    if(confirm("Nieruchmość zostanie usunięta. Jesteś pewien?"))
   
    $.ajax(
    {
        url: "nieruchomosci/usun/"+id,
        type: 'DELETE',
        data: {
            "id": id,
            "_token": token,
        },
        success: function (){
            console.log("it Works");
        }
        
    }).done(function(response){
        window.location.reload();
});
  
   
});
           
           
        });

        $(function(){
 

 $(".usunWynajmujacego").click(function(){
var id = $(this).data("id");
var token = $("meta[name='csrf-token']").attr("content");

$.ajax(
{
 url: "nieruchomosci/"+id,
 type: 'DELETE',
 data: {
     "id": id,
     "_token": token,
 },
 success: function (){
     console.log("it Works");
 }
}).done(function(response){
        window.location.reload();
});


});
    
    
 });
@endsection
