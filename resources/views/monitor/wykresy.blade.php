@extends('layouts.app1')

@section('content')



  

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Wykresy Zużycia Mediów</h1>
      </div>

      <div class="conteiner">
     
     
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

    
        <!-- <div class="chart-container" style="position: relative; height:40vh; width:80vw">
   
         <canvas id="myChart"></canvas>
         
        
        </div> -->
       @forelse ($monitor as $z)
        <div class="chart-container" style="position: relative; height:40vh; width:80vw">
      
        <canvas id="myChart{{$z->nieruchomosc}}"></canvas>
  
  
  </div>
  @empty
  <div class="chart-container" style="position: relative; height:40vh; width:80vw">
      
    <div>Nie znaleziono wykresów</div>


</div>
  @endforelse
      </div>
 

</div>




@endsection

@section('javascript')

$(function(){

    const test =  <?php echo json_encode($monitor) ?>;

   console.log(test);

 
    



    for (var i in test){

new Chart(document.getElementById('myChart' + test[i].nieruchomosc), {
  type: 'bar',
  data: {
    labels: test[i].miesiac,
    datasets: [{
      label: 'zużycie wody [m3]',
      data: test[i].woda,
      borderWidth: 1
    },
    {
      label: 'zużycie prądu [kw/h]',
      data: test[i].prad,
      borderWidth: 1
    },
    {
      label: 'zużycie gazu[kw/h]',
      data: test[i].gaz,
      borderWidth: 1
    }]
  },
  options: {
    plugins:{
        title:{
            display:true,
            text:'Wykres zużycia dla nieruchomości z ulicy ' + test[i].nieruchomosc
        }
    },
    scales: {
      y: {
        beginAtZero: true
      }
    }
  }
});

    }


    
    
 });

@endsection