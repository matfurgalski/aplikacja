@extends('layouts.app1')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edycja Nieruchomości</h1>
   
      </div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
              

                <div class="card-body">
                    <form method="POST" action="{{ route('nieruchomosci.update', $nieruchomosci->id) }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="nazwa" class="col-md-4 col-form-label text-md-end">{{ __('Nazwa') }}</label>

                            <div class="col-md-6">
                                <input id="nazwa" type="text" class="form-control @error('nazwa') is-invalid @enderror" name="nazwa" value="{{ $nieruchomosci->nazwa }}" required autocomplete="nazwa" autofocus>

                                @error('nazwa')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="opis" class="col-md-4 col-form-label text-md-end">{{ __('Notatki') }}</label>

                            <div class="col-md-6">
                                <textarea id="opis" class="form-control @error('opis') is-invalid @enderror" name="opis" required autocomplete="opis" autofocus>{{$nieruchomosci->opis}}</textarea>

                                @error('opis')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="powierzchnia" class="col-md-4 col-form-label text-md-end">{{ __('Powierzchnia(m2)') }}</label>

                            <div class="col-md-6">
                                <input id="powierzchnia" type="number" class="form-control @error('email') is-invalid @enderror" name="powierzchnia" value="{{ $nieruchomosci->powierzchnia }}" required autocomplete="powierzchnia">

                                @error('powierzchnia')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="liczba_pokoi" class="col-md-4 col-form-label text-md-end">{{ __('Liczba Pokoi') }}</label>

                            <div class="col-md-6">
                                <input id="liczba_pokoi" type="number" class="form-control @error('liczba_pokoi') is-invalid @enderror" name="liczba_pokoi" value="{{ $nieruchomosci->liczba_pokoi }}" required autocomplete="liczba_pokoi">

                                @error('liczba_pokoi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="ulica" class="col-md-4 col-form-label text-md-end">{{ __('Ulica') }}</label>

                            <div class="col-md-6">
                                <input id="ulica" type="text" class="form-control" name="ulica" value="{{ $nieruchomosci->ulica }}" required autocomplete="ulica">
                                @error('ulica')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="kod_pocztowy" class="col-md-4 col-form-label text-md-end">{{ __('Kod Pocztowy') }}</label>

                            <div class="col-md-6">
                                <input id="kod_pocztowy" type="text" class="form-control" name="kod_pocztowy" value="{{ $nieruchomosci->kod_pocztowy }}" required autocomplete="kod_pocztowy">
                                @error('kod_pocztowy')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="miasto" class="col-md-4 col-form-label text-md-end">{{ __('Miasto') }}</label>

                            <div class="col-md-6">
                                <input id="miasto" type="text" class="form-control" name="miasto" value="{{ $nieruchomosci->miasto }}" required autocomplete="miasto">
                                @error('miasto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Zapisz') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection