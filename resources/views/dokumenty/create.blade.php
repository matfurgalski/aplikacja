@extends('layouts.app1')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dodaj Dokument</h1>
   
      </div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
              

                <div class="card-body">
                    <form method="POST" action="{{ route('dokumenty.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label for="nazwa" class="col-md-4 col-form-label text-md-end">{{ __('Nazwa') }}</label>

                            <div class="col-md-6">
                                <input id="nazwa" type="text" class="form-control @error('nazwa') is-invalid @enderror" name="nazwa" value="{{ old('nazwa') }}" required autocomplete="nazwa" autofocus>

                                @error('nazwa')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
           

                        <div class="row mb-3">
                            <label for="plik" class="col-md-4 col-form-label text-md-end">{{ __('Plik') }}</label>

                            <div class="col-md-6">
                                <input id="plik" type="file" class="form-control" name="plik" >

                                @error('powierzchnia')
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