@extends('layouts.app1')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edycja Ogłoszenia</h1>
   
      </div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
              

                <div class="card-body">
                    <form method="POST" action="{{ route('ogloszenia.update', $ogloszenia->id) }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label for="tytul" class="col-md-4 col-form-label text-md-end">{{ __('Tytul') }}</label>

                            <div class="col-md-6">
                                <input id="tytul" type="text" class="form-control @error('nazwa') is-invalid @enderror" name="tytul" value="{{$ogloszenia->tytul}}" required autocomplete="nazwa" autofocus>

                                @error('tytul')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="opis" class="col-md-4 col-form-label text-md-end">{{ __('Opis') }}</label>

                            <div class="col-md-6">
                                <textarea id="opis" class="form-control @error('opis') is-invalid @enderror" name="opis"  autofocus>{{ $ogloszenia->opis }}"</textarea>

                                @error('opis')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="nieruchomosci_id" class="col-md-4 col-form-label text-md-end">{{ __('Wybierz nieruchomść') }}</label>

                            <div class="col-md-6">
                                <select class="form-select" name="nieruchomosci_id" id="nieruchomosci_id" aria-label="Default select example">
                                    <option value="{{ $ogloszenia->nieruchomosci_id }}" selected>{{$ogloszenia->ulica}} {{$ogloszenia->miasto}}</option>

                                    @foreach($nieruchomosci as $nieruchomosc)
                                    <option value="{{$nieruchomosc->id}}">{{$nieruchomosc->ulica}} {{$nieruchomosc->miasto}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="cena" class="col-md-4 col-form-label text-md-end">{{ __('Cena') }}</label>

                            <div class="col-md-6">
                                <input id="cena" type="number" class="form-control @error('cena') is-invalid @enderror" name="cena"  value="{{$ogloszenia->cena}}" required autocomplete="cena">

                                @error('cena')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="plik" class="col-md-4 col-form-label text-md-end">{{ __('Dodaj zdjęcia') }}</label>

                            <div class="col-md-6">                           
                                <input class="form-control" type="file" id="plik" name="plik[]" multiple>
                                @error('zdjecia')
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