@extends('layouts.app1')

@section('content')



  
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Temat: {{$temat}}</h1>
   
      </div>

      <div class="conteiner">
  <table class="table">
  <thead>
    <tr>
    
      <th scope="col">Od</th>
      <th scope="col">Wiadomość</th>
      <th scope="col">Data</th>
      



    </tr>
  </thead>
  <tbody>
    @foreach($wiadomosci as $wiadomosci)
    <tr>
     
      <td>{{$wiadomosci->name}} {{$wiadomosci->surname}}</td>
      <td>{{$wiadomosci->wiadomosc}}</td>
      <td>{{$wiadomosci->wiadomosci_created_at}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>
<form method="POST" action="{{ route('konwersacje.zapiszWiadomosc') }}" enctype="multipart/form-data">
                        @csrf
    <div class="row mb-3">
        
            <textarea id="wiadomosc" placeholder="Napisz wiadomość..." class="form-control @error('wiadomosc') is-invalid @enderror" name="wiadomosc"  autofocus>{{ old('wiadomosc') }}</textarea>

            @error('wiadomosc')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
       
    </div>

    <input id="konwersacja_id" type="hidden"  name="konwersacja_id" value="{{$konwersacja->id}}" >

    <div class="row mb-3  justify-content-center">

    <div class="row mb-4 col-4">
                            
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Wyslij') }}
                                </button>
                           
                    
                       
                            </div>
                            </div>
</form>
   
 
@endsection
