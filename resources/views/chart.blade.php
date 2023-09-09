<!DOCTYPE html>
<html>
<head>
    <title>Laravel 10 ChartJS Chart Example - ItSolutionStuff.com</title>
</head>
    
<body>
    <div style="width: 900px;margin:auto">
        <canvas id="chart" height="100px"></canvas>
    </div>
</body>
  

  
<script type="text/javascript">
      
      var ctx = document.getElementById('chart').getContext('2d');
      var userChart = new Chart(ctx,{
        type:'bar',
        data:{
            labels: {!! json_encode($labels) !!},
            datasets: {!! json_encode($datasets) !!}
        },
      });
  
</script>
</html>