@extends('layouts.app1')

@section('content')




<div class="container px-4 py-5" id="hanging-icons">
    <h2 class="pb-2 border-bottom">Dzień dobry, {{Auth::user()->name}}</h2>
    <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
      <div class="col d-flex align-items-start">
        <div class="icon-square bg-light text-dark flex-shrink-0 me-3">
          <svg class="bi" width="1em" height="1em"><use xlink:href="#home"/></svg>
        </div>
        <div>
          <h1 >{{$liczbaNieruchomosci}}</h1>
          <p class="fs-8 ">Zarządzane nieruchomości</p>
     
         
        </div>
      </div>
      <div class="col d-flex align-items-start">
        <div class="icon-square bg-light text-dark flex-shrink-0 me-3">
          <svg class="bi" width="1em" height="1em"><use xlink:href="#card-checklist"/></svg>
        </div>
        <div>
        <h1 >{{$oczekujaceZadania}}</h1>
          <p class="fs-8">Oczekujące zgłoszenia</p>
     
        </div>
      </div>

      <div class="col d-flex align-items-start">
        <div class="icon-square bg-light text-dark flex-shrink-0 me-3">
          <svg class="bi" width="1em" height="1em"><use xlink:href="#pigi"/></svg>
        </div>
        <div>
        <h1 >{{$sumaWydatki}} zł</h1>
          <p class="fs-8 ">Suma wydatków</p>
        </div>
      </div>

      <div class="col d-flex align-items-start">
        <div class="icon-square bg-light text-dark flex-shrink-0 me-3">
          <svg class="bi" width="1em" height="1em"><use xlink:href="#pigi"/></svg>
        </div>
        <div>
        <h1 >{{$sumaPrzychody}} zł</h1>
          <p class="fs-8">Suma przychodów</p>
        </div>
      </div>

      <div class="col d-flex align-items-start">
        <div class="icon-square bg-light text-dark flex-shrink-0 me-3">
          <svg class="bi" width="1em" height="1em"><use xlink:href="#card-checklist"/></svg>
        </div>
        <div>
        <h1 >{{$liczbaOgloszen}}</h1>
          <p class="fs-8">Liczba wystawionych ogłoszeń</p>
        </div>
      </div>

      <div class="col d-flex align-items-start">
        <div class="icon-square bg-light text-dark flex-shrink-0 me-3">
          <svg class="bi" width="1em" height="1em"><use xlink:href="#tools"/></svg>
        </div>
   
      </div>
    </div>
  </div>
  @endsection