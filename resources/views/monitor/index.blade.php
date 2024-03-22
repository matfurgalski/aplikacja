@extends('layouts.app1')

@section('content')



  
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Zużycie Mediów</h1>
        @can('isWynajmujacy')
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <a type="button" href="/monitor/dodajZuzycie" class="btn btn-sm btn-outline-secondary">Dodaj zużycie +</a>
            
          </div>
       
        </div>
        @endcan
        @can('isWlasciciel')
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <a type="button" href="/monitor/wykresy" class="btn btn-sm btn-outline-secondary">Wykresy zużycia mediów</a>
            
          </div>
       
        </div>
        @endcan

        
      </div>

      <div class="conteiner">
  <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Woda</th>
      <th scope="col">Prąd</th>
      <th scope="col">Gaz</th>
      <th scope="col">Opis</th>
      <th scope="col">Data</th>
      <th scope="col">Nieruchomość</th>
      @can('isWynajmujacy')
      <th scope="col">Akcje</th>
      @endcan


    </tr>
  </thead>
  <tbody>
    @foreach($monitor as $monitor)
    <tr>
      <th scope="row">{{$count++}}</th>
      <td>{{$monitor->woda}} m3</td>
      <td>{{$monitor->prad}} kWh</td>
      <td>{{$monitor->gaz}} kWh</td>
      <td>{{$monitor->notatki}}</td>
      <td>{{$monitor->updated_at}}</td>
      <td>{{$monitor->ulica}} {{$monitor->miasto}}</td>

      @can('isWynajmujacy')
      <td>
        <button class="btn btn-danger btn-sm delete" data-id="{{$monitor->id}}"> X </button>
      </td>
      @endcan
    </tr>
    @endforeach
  </tbody>
</table>
</div>

@if (session('alert'))
    <div class="alert alert-success">
        {{ session('alert') }}
    </div>
@endif

   
 
@endsection
@section('javascript')

    $(function(){
 

        $(".delete").click(function(){
    var id = $(this).data("id");
    var token = $("meta[name='csrf-token']").attr("content");
   
    $.ajax(
    {
        url: "monitor/"+id,
        type: 'DELETE',
        data: {
            "id": id,
            "_token": token,
        },
        success: function (){
            console.log("it Works");
        }
    })
    .done(function(response){
        window.location.reload();
    });

    
   
});
           
           
        });

@endsection