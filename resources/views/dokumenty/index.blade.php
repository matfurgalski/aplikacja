@extends('layouts.app1')

@section('content')



  
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Wszystkie Dokumenty</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <a type="button" href="/dokumenty/dodajDokument" class="btn btn-sm btn-outline-secondary">Dodaj dokument +</a>
            
          </div>
       
        </div>
      </div>

      <div class="conteiner">
  <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nazwa</th>
      <th scope="col">Data dodania</th>
      <th scope="col">Akcje</th>
      



    </tr>
  </thead>
  <tbody>
    @foreach($dokumenty as $dokument)
    <tr>
      <th scope="row">{{$count++}}</th>
      <td>{{$dokument->nazwa}}</td>
      <td>{{$dokument->created_at}}</td>   
      <td>
        <button class="btn btn-danger btn-sm delete" data-id="{{$dokument->id}}"> X </button>
        <a href=" {{route('dokumenty.fileDownload', $dokument->id)}}"class="btn btn-primary btn-sm delete"> <span data-feather="download"></span> Pobierz </a>
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
        url: "dokumenty/"+id,
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