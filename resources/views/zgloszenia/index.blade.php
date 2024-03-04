@extends('layouts.app1')

@section('content')



  
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Moje zgłoszenia</h1>
        @if($errors->any())
<h6 style="color:red;">{{$errors->first()}}</h6>
@endif
        @can('isWynajmujacy')
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <a type="button" href="/zgloszenia/dodajZgloszenie" class="btn btn-sm btn-outline-secondary">Dodaj zgłoszenie +</a>
            
          </div>
       
        </div>
        @endcan
      </div>

      <div class="conteiner">
        <div class="table-responsive-sm">
  <table class="table ">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Temat</th>
      <th scope="col" style="width: 40%">Opis</th>
      <th scope="col">Typ zgłoszenia</th>
      <th scope="col">Status</th>
      <th scope="col">Data</th>
      <th scope="col">Zgłaszający</th>
      <th scope="col">Akcje</th>
    


    </tr>
  </thead>
  <tbody>


    @foreach($zgloszenia as $zgloszenia)
    <tr>
      <th scope="row">{{$count++}}</th>
      <td>{{$zgloszenia->temat}}</td>
      <td>{{$zgloszenia->opis}}</td>
      <td>{{$zgloszenia->typ_zgloszenia}}</td>
      <td>{{$zgloszenia->status}}</td>
      <td>{{$zgloszenia->zgloszenia_created_at}}</td>  
      <td>{{$zgloszenia->name}} {{$zgloszenia->surname }}</td>
      <td>
      
        <a class="btn btn-danger btn-sm "> 
        <button class="btn btn-danger btn-sm delete" data-id="{{$zgloszenia->zgloszenia_id}}"> X </button>
      </a>
        @can('isWlasciciel')
        <a href=" {{route('zgloszenia.zmienStatus', $zgloszenia->zgloszenia_id)}}"class="btn btn-primary btn-sm "> 
        <button class="btn btn-primary btn-sm " >  <i class="me-1 fa fa-heart fa-lg"></i> Zmien status </button>
      </a>
        @endcan
      </td>
    </tr>
    @endforeach


  </tbody>
</table>
</div>
</div>

   
 
@endsection
@section('javascript')


     $(function(){
 

    $(".delete").click(function(){
    var id = $(this).data("id");
    var token = $("meta[name='csrf-token']").attr("content");

    $.ajax(
    {
    url: "zgloszenia/"+id,
    type: 'DELETE',
    data: {
        "id": id,
        "_token": token,
    },
    success: function (){
        console.log("it Works");
    }
    })
    .done(setTimeout(function(response){
    window.location.reload();
    }));



    });
        
        
    });

 

@endsection