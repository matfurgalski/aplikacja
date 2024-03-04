@extends('layouts.app1')

@section('content')



  
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Moje Ulubione</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
       
        </div>
      </div>

      <div class="conteiner">
  <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nazwa</th>
      <th scope="col">Powierzchnia</th>
      <th scope="col">Liczba pokoi</th>
      <th scope="col">Ulica</th>
      <th scope="col">Kod pocztowy</th>
      <th scope="col">Miasto</th>
      <th scope="col">Akcje</th>



    </tr>
  </thead>
  <tbody>
    @foreach($ulubione as $ulubione)
    <tr>
      <th scope="row">{{$count++}}</th>
      <td>{{$ulubione->tytul}}</td>
      <td>{{$ulubione->powierzchnia}}</td>
      <td>{{$ulubione->liczba_pokoi}}</td>
      <td>{{$ulubione->ulica}}</td>
      <td>{{$ulubione->kod_pocztowy}}</td>
      <td>{{$ulubione->miasto}}</td>
      <td>
        <button class="btn btn-danger btn-sm delete" data-id="{{$id}}"> X </button>
        <a href=" {{route('ogloszenia.podgladOgloszenia', $ulubione->ogloszenia_id)}}"class="btn btn-primary shadow-0"> <span data-feather="eye"></span> Przejdź do ogłoszenia</a>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>

   
 
@endsection
@section('javascript')


     $(function(){
 

    $(".delete").click(function(){
    var id = $(this).data("id");
    var token = $("meta[name='csrf-token']").attr("content");

    $.ajax(
    {
    url: "ulubione/"+id,
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