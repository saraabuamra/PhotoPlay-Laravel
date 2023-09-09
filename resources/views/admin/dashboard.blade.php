@extends('layouts.admin')

@section('title')
Dashboard
@endsection

@section('contentheader')
    Dashboard
@endsection

@section('content')
    <body>
        <style>
            .parent {
            position: relative;
            top: 0;
            left: 0;
            }

            .image1 {
            position: relative;
            top: 0;
            left: 0;
            border: 1px solid #000000;
            }

            .image2 {
            position: absolute;
            top: 30px;
            left: 30px;
            border: 1px solid #000000;
            }
        </style>
        <div class="parent">
        <div class="image1" style="background-image: url({{asset('admin/images/dash.png')}});background-size:cover;background-repeat:no-repeat;min-height:740px; opacity: 0.5;"></div>
        <div class="image2" style="width: 900px;margin:auto">
            <canvas id="chart" height="100px"></canvas>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
        </div>
    </body>
@endsection


@section('contentheaderlink')
    <a href="{{route('dashboard')}}">Dashboard</a>
@endsection

@section('contentheaderactive')
view
@endsection