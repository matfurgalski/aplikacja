@extends('layouts.app1')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Zmień Status</h1>
   
      </div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
              

                <div class="card-body">
                    <form method="POST" action="{{ route('zgloszenia.zapiszStatus') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="surname" class="col-md-4 col-form-label text-md-end">{{ __('Status') }}</label>

                            <div class="col-md-6">
                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                <input type="radio" class="btn-check" name="status" id="oczekujace" value="oczekujace" autocomplete="off" checked>
                                <label class="btn btn-outline-primary" for="oczekujace">Oczekujące</label>

                                <input type="radio" class="btn-check" name="status" id="wTrakcie" value="w trakcie realizacji" autocomplete="off">
                                <label class="btn btn-outline-primary" for="wTrakcie">W trakcie realizacji</label>

                                <input type="radio" class="btn-check" name="status" id="zakonczone" value="zakonczone" autocomplete="off">
                                <label class="btn btn-outline-primary" for="zakonczone">Zakończone</label>

                                <input id="id" type="hidden"  name="zgloszenia_id" value="{{ $zgloszenia->id }}">
                       
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