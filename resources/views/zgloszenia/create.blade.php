@extends('layouts.app1')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dodaj Zgłoszenie</h1>
   
      </div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
              

                <div class="card-body">
                    <form method="POST" action="{{ route('zgloszenia.store') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="nazwa" class="col-md-4 col-form-label text-md-end">{{ __('Temat') }}</label>

                            <div class="col-md-6">
                                <input id="nazwa" type="text" class="form-control @error('temat') is-invalid @enderror" name="temat" value="{{ old('temat') }}" required autocomplete="temat" autofocus>

                                @error('temat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="opis" class="col-md-4 col-form-label text-md-end">{{ __('Opis') }}</label>

                            <div class="col-md-6">
                                <textarea id="opis" class="form-control @error('opis') is-invalid @enderror" name="opis" required  autofocus>{{ old('opis') }}</textarea>

                                @error('opis')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="surname" class="col-md-4 col-form-label text-md-end">{{ __('Typ zgłoszenia') }}</label>

                            <div class="col-md-6">
                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">

                                <input type="radio" class="btn-check" name="typ_zgloszenia" id="problem" value="problem" autocomplete="off" checked>
                                <label class="btn btn-outline-primary" for="problem">Problem</label>

                                <input type="radio" class="btn-check" name="typ_zgloszenia" id="awaria" value="awaria" autocomplete="off">
                                <label class="btn btn-outline-primary" for="awaria">Awaria</label>

                                
                                </div>
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