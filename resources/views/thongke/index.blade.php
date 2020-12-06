@extends('layouts.app')

@section('content')


<canvas id="myChart" class="sup-chart" width="200" height="200"></canvas>
<h4 id="h2-chart">Biểu đồ điểm cảm xúc</h4>
<br>
<canvas id="myChart1" class="sup-chart" width="200" height="200"></canvas>
<h4 id="h2-chart">Biểu đồ Điện thoại viên</h4>
<style>
  .sup-chart{
    max-height: 500px;
    max-width:  500px;
    margin: 0 auto;
  }
  #h2-chart{
    text-align: center;
  }
</style>
<?php
$labels = [];
$data = [];
  foreach ($dataCount as $key => $value) {
    array_push($labels, $key);
    array_push($data, $value);
  }
$data1 =implode(',', $dataCount);

 ?>
<script type="text/javascript">
    let data = [ {{ $data1 }} ];

</script>
<script type="text/javascript" src="js/chart.js"></script>
@endsection
