@extends('layouts.app1')

@section('content')



  
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Moje Wydatki / Przychody</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <a type="button" href="/statystyki/dodajStatystyke" class="btn btn-sm btn-outline-secondary">Dodaj wydatek / przychód +</a>
            
          </div>
       
        </div>
      </div>

      <div class="conteiner">
  <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Wydatek / Przychód</th>
      <th scope="col">Kwota [zł]</th>
      <th scope="col">Notatka</th>
      <th scope="col">Nieruchomość</th>
      <th scope="col">Data</th>
      <th scope="col">Akcje</th>



    </tr>
  </thead>
  <tbody>
    @foreach($statystyki as $statystyki)
    <tr>
      <th scope="row">{{$count++}}</th>
      <td>{{$statystyki->rodzaj}}</td>
      <td>{{$statystyki->kwota}}</td>
      <td>{{$statystyki->notatki}}</td>
      <td>{{$statystyki->ulica}} {{$statystyki->miasto}}</td>
      <td>{{$statystyki->created_at}}</td>
      <td>
        <button class="btn btn-danger btn-sm delete" data-id="{{$statystyki->id}}"> X </button>
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
        url: "statystyki/"+id,
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