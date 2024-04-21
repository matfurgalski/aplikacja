@extends('layouts.app1')

@section('content')

@forelse($ogloszenia as $ogloszenie)
<div class="row justify-content-center mb-3">
          <div class="col-md-12">
            <div class="card shadow-0 border rounded-3">
              <div class="card-body">
                <div class="row g-0">                 
                  <div class="col-xl-3 col-md-4 d-block justify-content-center">
                    <div class="bg-image hover-zoom ripple rounded ripple-surface me-md-3 mb-3 mb-md-0  ">

                        <div id="carouselExampleFade{{$ogloszenie->id}}" class="carousel slide carousel-fade">
                            
                    <div class="carousel-inner">
                        @foreach($zdjecia as $zdjecie )
                        @if($ogloszenie->id == $zdjecie->ogloszenia_id)
                        <div class="carousel-item active  " >
        
                        <img src="{{asset('storage/' . $zdjecie->file_path) }}" class=" mx-auto d-block"  style="width: 250px; height: 260px;" alt="...">
                        </div>
                        
                        @endif
                        @endforeach
                        

                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade{{$ogloszenie->id}}" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade{{$ogloszenie->id}}" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                    </div>

                    </div>
                  </div>
                 
                  <div class="col-xl-6 col-md-5 col-sm-7">
                    <h5>{{$ogloszenie->tytul}}</h5>
                    <div class="d-flex flex-row">
                    
                      <span class="text-muted">Pokoje: {{$ogloszenie->liczba_pokoi}} | Powierzchnia: {{$ogloszenie->powierzchnia}} m2</span>
                    </div>

                    <p class="text mb-4 mb-md-0">
                   
                    {!!nl2br(substr( $ogloszenie->opis, 0, 150))!!}...
                    </p>
                  </div>
                  <div class="col-xl-3 col-md-3 col-sm-5">
                    <div class="d-flex flex-row align-items-center mb-1">
                      <h4 class="mb-1 me-1">Cena: {{$ogloszenie->cena}} zł </h4>
                     
                    </div>
                    <h6 class="text-primary">Adres: {{$ogloszenie->miasto}}, {{$ogloszenie->kod_pocztowy}}, {{$ogloszenie->ulica}}</h6>
                    @if($ogloszenie->rezerwacja_id)
                    <h6 class="text-danger">Status: Zarezerwowane</h6>
                    @else
                    <h6 class="text-success">Status: Dostępne</h6>
                    @endif
                    <small class="text-muted">data dodania: {{$ogloszenie->created_at}}</small>
                    
                    <div class="mt-4 item">
                    <a href=" {{route('ogloszenia.podgladOgloszenia', $ogloszenie->id)}}"class="btn btn-primary shadow-0"> <span data-feather="eye"></span> Podgląd</a>
                    <button id="button-ulubione"dusk="ulubione-button"class="btn btn-light border border-secondary py-2 icon-hover px-3 ulubione" data-id="{{$ogloszenie->id}}">  <i class="me-1 fa fa-heart fa-lg"></i> Dodaj do ulubionych </button>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>        
        </div>
        @empty
        <div>Brak ogłoszeń</div>

        @endforelse


   
 
@endsection

@section('javascript')

    $(function(){
 

        $(".ulubione").click(function(){
    var id = $(this).data("id");
    var token = $("meta[name='csrf-token']").attr("content");
   
    $.ajax(
    {
        url: "ogloszenia/"+id+"/dodajUlubione",
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