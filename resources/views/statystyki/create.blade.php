@extends('layouts.app1')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dodaj Wydatek / Przychód</h1>
   
      </div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
              

                <div class="card-body">
                    <form method="POST" action="{{ route('statystyki.store') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="rodzaj" class="col-md-4 col-form-label text-md-end">{{ __('Rodzaj') }}</label>

                            <div class="col-md-6">
                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">

                                <input type="radio" class="btn-check" name="rodzaj" id="wydatek" value="wydatek" autocomplete="off" checked>
                                <label class="btn btn-outline-primary" for="wydatek">Wydatek</label>

                                <input type="radio" class="btn-check" name="rodzaj" id="przychod" value="przychod" autocomplete="off">
                                <label class="btn btn-outline-primary" for="przychod">Przychód</label>

                                
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="nieruchomosci_id" class="col-md-4 col-form-label text-md-end">{{ __('Wybierz nieruchomść') }}</label>

                            <div class="col-md-6">
                                <select class="form-select" name="nieruchomosci_id" id="nieruchomosci_id" aria-label="Default select example">
                                    <option selected>Wybierz...</option>

                                    @foreach($nieruchomosci as $nieruchomosc)
                                    <option value="{{$nieruchomosc->id}}">{{$nieruchomosc->ulica}}, {{$nieruchomosc->kod_pocztowy}}, {{$nieruchomosc->miasto}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="kwota" class="col-md-4 col-form-label text-md-end">{{ __('Kwota') }}</label>

                            <div class="col-md-6">
                                <input id="kwota" type="number" class="form-control @error('kwota') is-invalid @enderror" name="kwota" value="{{ old('kwota') }}" required autocomplete="woda" autofocus>

                                @error('kwota')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                       

                        
                        <div class="row mb-3">
                            <label for="notatki" class="col-md-4 col-form-label text-md-end">{{ __('Opis') }}</label>

                            <div class="col-md-6">
                                <textarea id="notatki" class="form-control @error('notatki') is-invalid @enderror" name="notatki"  autofocus>{{ old('notatki') }}</textarea>

                                @error('notatki')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                       

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Dodaj') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection