@extends('layouts.app1')

@section('content')



  
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Moje Ogłoszenia</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <a type="button" href="/ogloszenia/dodajOgloszenie" class="btn btn-sm btn-outline-secondary">Dodaj ogłoszenie +</a>
            
          </div>
       
        </div>
      </div>

      <div class="conteiner">
  <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Tytuł</th>
      <th scope="col">Cena [zł]</th>
      <th scope="col">Ulica</th>
      <th scope="col">Data wystawienia:</th>
      <th scope="col">Akcje</th>



    </tr>
  </thead>
  <tbody>
    @forelse($ogloszenia as $ogloszenie)
    <tr>
      <th scope="row">{{$count++}}</th>
      <td>{{$ogloszenie->tytul}}</td>
      <td>{{$ogloszenie->cena}}</td>
      <td>{{$ogloszenie->ulica}}</td>
      <td>{{$ogloszenie->created_at}}</td>
      <td>
        <button id="button-id" class="btn btn-danger btn-sm delete" data-id="{{$ogloszenie->id}}"> X </button>
        <a href=" {{route('ogloszenia.podgladOgloszenia', $ogloszenie->id)}}"class="btn btn-primary btn-sm delete"> <span data-feather="eye"></span> Podgląd</a>
        <a href=" {{route('ogloszenia.edit', $ogloszenie->id)}}"> 
        <button class="btn btn-success btn-sm " > Edytuj ogłoszenie </button>
      </a>
      </td>
    </tr>
    @empty
    <tr>
      <th scope="row"></th>
      <td>{{__('Brak ogłoszeń')}}</td>
  
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
        url: "ogloszenia/"+id,
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