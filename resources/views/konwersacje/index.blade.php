@extends('layouts.app1')

@section('content')



  
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Moje Konwersacje</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <a type="button" href="/konwersacje/stworzKonwersacje" class="btn btn-sm btn-outline-secondary">Stwórz konwersacje +</a>
            
          </div>
       
        </div>
      </div>

      <div class="conteiner">
  <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Temat</th>
      <th scope="col">Nadawca</th>
      <th scope="col">Odbiorca</th>
      <th scope="col" style="width: 40%">Ostatnia wiadomość</th>
      <th scope="col">Akcje</th>



    </tr>
  </thead>
  <tbody>

 
    @forelse($konwersacje as $konwersacja)
    <tr>
      <th scope="row">{{$count++}}</th>
      <td>{{$konwersacja->temat}}</td>
      <td>{{$konwersacja->name}} {{$konwersacja->surname}} - {{$konwersacja->email}}</td>
      <td>{{$konwersacja->odbiorca_name}} {{$konwersacja->odbiorca_surname}} - {{$konwersacja->odbiorca_email}}</td>
      <td>{{$konwersacja->autor_wiadomosci}}: {{$konwersacja->wiadomosc}}</td>
      <td>
        <button class="btn btn-danger btn-sm delete" data-id="{{$konwersacja->konwersacje_id}}"> X </button>
        <a href=" {{route('konwersacje.podgladKonwersacji', $konwersacja->konwersacje_id)}}"class="btn btn-primary btn-sm "> <span data-feather="eye"></span> Odpowiedz</a>
      </td>
    </tr>
    @empty
    <tr>
      <th scope="row"></th>
      <td>{{__('Nie znaleziono konwersacji')}}</td>
  
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
   
    $.ajax(
    {
        url: "konwersacje/"+id,
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