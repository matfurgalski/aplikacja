@extends('layouts.app1')

@section('content')

@foreach($ogloszenia as $ogloszenia)
<section class="py-5">
  <div class="container">
    <div class="row gx-5">
      <aside class="col-lg-6">
      <div id="carouselExampleFade" class="carousel slide carousel-fade">
                            
                            <div class="carousel-inner">
                                @foreach($zdjecia as $key => $zdjecie )
                             
                                <div class="carousel-item {{$key==0? 'active':''}}  " >
                
                                <img src="{{asset('storage/' . $zdjecie->file_path) }}" class=" mx-auto d-block "  style="width: 600px; height: 600px;" alt="...">
                                </div>
                                
                               
                                @endforeach
                                
        
                            </div>
        
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
        <!-- thumbs-wrap.// -->
        <!-- gallery-wrap .end// -->
      </aside>
      <main class="col-lg-6">
        <div class="ps-lg-3">
          <h4 class="title text-dark">
            {{$ogloszenia->tytul}}
          </h4>
          <div class="d-flex flex-row my-3">
            <div class="text-warning mb-1 me-2">
          
            </div>

     
            <span class="text-muted"><i class="fas fa-shopping-basket fa-sm mx-1"></i>Adres: {{$ogloszenia->miasto}}, {{$ogloszenia->kod_pocztowy}}, {{$ogloszenia->ulica}}</span>
            @if($ogloszenia->rezerwacja_id)
           
            <span class="text-danger ms-2">          
                    Zarezerwowane 
            </span> 
            
            @else    
           <span class="text-success ms-2">
            Dostępne
            </span>
            @endif
          </div>

          <div class="mb-3">
            <span class="h5">{{$ogloszenia->cena}} zł</span>
            <span class="text-muted">/za miesiąc</span></br>
            <span class="text-muted">wystawione: {{$ogloszenia->created_at}}</span>
          </div>

        
          <div class="row">
            <dt class="col-3">Liczba pokoi:</dt>
            <dd class="col-9">{{$ogloszenia->liczba_pokoi}}</dd>

            <dt class="col-3">Powierzchnia:</dt>
            <dd class="col-9">{{$ogloszenia->powierzchnia}} m2</dd>

          </div>
          <p>
            {!!nl2br($ogloszenia->opis)!!}
          </p>
          <hr />
          @if($ogloszenia->rezerwacja_id && $ogloszenia->wlasciciel_id == Auth::user()->id )
          <h4 class="title text-dark">
           Dane rezerwującego
          </h4>
          @foreach($user as $user)
          <div class="row">
            <dt class="col-3">Imię:</dt>
            <dd class="col-9">{{$user->name}}</dd>

            <dt class="col-3">Nazwisko:</dt>
            <dd class="col-9">{{$user->surname}}</dd>

            <dt class="col-3">Email:</dt>
            <dd class="col-9">{{$user->email}}</dd>

          </div>
            @endforeach
            @endif
         
          @can('isWynajmujacy')
          @if($ogloszenia->rezerwacja_id == null)
          <button class="btn btn-warning shadow-0 zarezerwuj" data-id="{{$ogloszenia->id}}">  Zarezerwuj </button>
          @elseif($ogloszenia->rezerwacja_id == Auth::user()->id)
          <button class="btn btn-warning shadow-0 anulujRezerwacje" data-id="{{$ogloszenia->id}}">  Anuluj rezerwacje </button>
          @else
          @endif
          <a href="{{route('konwersacje.createWiadomosc', $ogloszenia->wlasciciel_id)}}" class="btn btn-primary shadow-0"> <i class="me-1 fa fa-shopping-basket"></i> Napisz wiadomość</a>
          <button class="btn btn-light border border-secondary py-2 icon-hover px-3 ulubione" data-id="{{$ogloszenia->id}}">  <i class="me-1 fa fa-heart fa-lg"></i> Dodaj do ulubionych </button>
           @endcan

           @can('isWlasciciel')
           @if($ogloszenia->wlasciciel_id == Auth::user()->id && $ogloszenia->rezerwacja_id )
           <button class="btn btn-warning shadow-0 anulujRezerwacje" data-id="{{$ogloszenia->id}}">  Anuluj rezerwacje </button>
           <a href="{{route('konwersacje.createWiadomosc', $ogloszenia->rezerwacja_id)}}" class="btn btn-primary shadow-0"> <i class="me-1 fa fa-shopping-basket"></i> Napisz wiadomość</a>
           @endif

           @endcan

        </div>
      </main>
    </div>
  </div>
</section>
<!-- content -->

@endforeach

   
 
@endsection
@section('javascript')

    $(function(){
 

        $(".ulubione").click(function(){
    var id = $(this).data("id");
    var token = $("meta[name='csrf-token']").attr("content");
   
    $.ajax(
    {
        url: "dodajUlubione",
        type: 'post',
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

        $(function(){
 

 $(".zarezerwuj").click(function(){
var id = $(this).data("id");
var token = $("meta[name='csrf-token']").attr("content");

$.ajax(
{
 url: "rezerwacja",
 type: 'post',
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
 
 $(function(){
 

 $(".anulujRezerwacje").click(function(){
var id = $(this).data("id");
var token = $("meta[name='csrf-token']").attr("content");

$.ajax(
{
 url: "anulujRezerwacje",
 type: 'post',
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