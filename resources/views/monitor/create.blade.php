@extends('layouts.app1')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dodaj Zużycie</h1>
   
      </div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
              

                <div class="card-body">
                    <form method="POST" action="{{ route('monitor.store') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="woda" class="col-md-4 col-form-label text-md-end">{{ __('Woda(m3)') }}</label>

                            <div class="col-md-6">
                                <input id="woda" type="number" class="form-control @error('woda') is-invalid @enderror" name="woda" value="{{ old('woda') }}" required autocomplete="woda" autofocus>

                                @error('woda')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="prad" class="col-md-4 col-form-label text-md-end">{{ __('Prąd(kWh)') }}</label>

                            <div class="col-md-6">
                            <input id="prad" type="number" class="form-control @error('prad') is-invalid @enderror" name="prad" value="{{ old('prad') }}" required autocomplete="prad">

                                @error('prad')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="gaz" class="col-md-4 col-form-label text-md-end">{{ __('Gaz(kWh)') }}</label>

                            <div class="col-md-6">
                                <input id="gaz" type="number" class="form-control @error('gaz') is-invalid @enderror" name="gaz" value="{{ old('gaz') }}" required autocomplete="gaz">

                                @error('gaz')
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