@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
@stop

@section('content')

@include('layouts.alert')

<section class="content">
  <div class="container-fluid">
    <!-- Info boxes -->
    <div class="row">
      <div class="col-12 col-sm-6 col-md-4">
        <div class="small-box bg-gradient-success">
          <div class="inner">
            <h3>{{ $Users_number }}</h3>
            <p>Utenti registrati</p>
          </div>
          <div class="icon">
            <i class="fas fa-user-plus"></i>
          </div>
          <a href="{{ url('/admin/user') }}" class="small-box-footer">
            Lista utenti <i class="fas fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>

      <div class="col-12 col-sm-6 col-md-4">
        <div class="small-box bg-gradient-info">
          <div class="inner">
          <h3>{{ $Completed_orders_number }}</h3>
            <p>Prodotti venduti</p>
          </div>
          <div class="icon">
            <i class="fas fa-shopping-cart"></i>
          </div>
          <a href="{{ url('/admin/product') }}" class="small-box-footer">
            Lista prodotti <i class="fas fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>

      <div class="col-12 col-sm-6 col-md-4">
        <div class="small-box bg-gradient-danger">
          <div class="inner">
            <h3>{{ $Open_orders_number }}</h3>
            <p>Ordini aperti</p>
          </div>
          <div class="icon">
            <i class="fas fa-times-circle"></i>
          </div>
          <a href="{{ url('/admin/panelcontrol') }}" class="small-box-footer">
            Risolvi ordini <i class="fas fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>


    </div>
    <!-- /.col -->

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header bg-dark">
          <h5 class="card-title">Rapporto annuale</h5>

          <div class="card-tools">

            <div class="btn-group">
                    <!-- <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                      <i class="fas fa-wrench"></i>
                    </button> -->
                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                      <a href="#" class="dropdown-item">Action</a>
                      <a href="#" class="dropdown-item">Another action</a>
                      <a href="#" class="dropdown-item">Something else here</a>
                      <a class="dropdown-divider"></a>
                      <a href="#" class="dropdown-item">Separated link</a>
                    </div>
                  </div>
                  <!--<button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button> -->
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-8">
                    <p class="text-center">
                      <strong id="salesyear"></strong>
                    </p>

                    <div class="chart"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                    <!-- Sales Chart Canvas -->
                    <canvas id="salesChart" height="180" style="height: 180px; display: block; width: 1053px;" width="1053" class="chartjs-render-monitor"></canvas>
                  </div>
                  <!-- /.chart-responsive -->
                </div>
                <!-- /.col -->

                <div class="col-md-4">

                  <div class="card-header">
                    <h3 class="card-title">Rapporto vendite annuali</h3>
                  </div>

                  <ul class="users-list clearfix margin: 1rem" style="margin: 0px;margin-left: 2px">
                    <li style="padding: 0px;">
                      <div class="progress-group">
                        2020:&nbsp;&nbsp;<strong id="thisyear" class="text-success"></strong>
                      </div>
                    </li>


                  </ul>

                  <ul class="users-list clearfix" style="margin: 0;margin-left: 2px">

                    <li style="padding: 0px;">
                      <div class="progress-group" >
                        2019:&nbsp;&nbsp;<strong id="lastyear" class="text-secondary"></strong>
                      </div>
                    </li>

                  </ul>










                </div>
                <!-- /.row -->
              </div>
              <!-- ./card-body -->

              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Main row -->
        <div class="row w-100">
          <!-- Left col -->
          <div class="col-md-12 p-0">
            <!-- MAP & BOX PANE -->
            <div class="card ml-3">
              <div class="card-header border-0 bg-dark">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Grafico prodotti venduti per prezzo</h3>
                  <!-- <a href="javascript:void(0);">View Report</a> -->
                </div>
              </div>
              <div class="card-body">
                <div class="d-flex">
                  <p class="d-flex flex-column">
                    <span class="text-bold text-lg"></span>
                    <span></span>
                  </p>
                  <p class="ml-auto d-flex flex-column text-right">
                    <span class="text-success">
                      <!-- <i class="fas fa-arrow-up"></i> -->
                    </span>
                    <span class="text-muted"></span>
                  </p>
                </div>
                <!-- /.d-flex -->

                <div class="position-relative mb-4"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                <canvas id="visitors-chart" height="200" style="display: block; width: 766px; height: 200px;" width="766" class="chartjs-render-monitor"></canvas>
              </div>

              <div class="d-flex flex-row justify-content-end">
                <span class="mr-2">
                  <i class="fas fa-square" style="color:#c2b280"></i> 2020
                </span>

                <span>
                  <i class="fas fa-square text-gray"></i> 2019
                </span>
              </div>
            </div>
          </div>


          <!-- TABLE: LATEST ORDERS -->
          <div class="card ml-3">
            <div class="card-header border-transparent bg-dark">
              <h3 class="card-title">Ultimi ordini</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-plus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table m-0">
                  <thead>
                    <tr>
                      <th>Order ID</th>
                      <th>Item</th>
                      <th>Status</th>
                      <th>Popularity</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($Lastest_completed_orders as $orders)
                    <tr>
                      <td> {{$orders->id}} </td>
                      <td>{{$orders->id}} </td>
                      <td><span class="badge badge-success">Shipped</span></td>
                      <td>
                        <div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
              <a href="{{ url('/admin/createorder') }}" class="btn btn-sm btn-info float-left">Crea nuovo ordine</a>
              <a href="{{ url('/admin/panelcontrol') }}" class="btn btn-sm btn-secondary float-right">Visualizza ordini</a>
            </div>
            <!-- /.card-footer -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
        <!-- /.row -->
        <!--/. container-fluid -->
      </section>


      <p>

  </p>

    @stop

    @section('css')


    <link rel="stylesheet" href="/css/admin_custom.css">


    @stop

    @section('js')

    @include('construct.badgeorder')
    <script src="{{ asset('js/dashboard2.js') }}"></script>
    <script src="{{ asset('js/tablesorter.js') }}"></script>
    {{-- <script src="{{ asset('js/dashboard2.js') }}"></script> --}}

    {{-- INVENTORY: --}}
    <script>
      $(document).ready(function() {
        {{-- var ciao = {!! json_encode($Pizze->toArray()) !!}; --}}
        {{-- $("i:eq(0)").text($.inArray("Jupiter", planets)); // search array for Jupiter --}}
        var number = 0;
        var obj = {!! $Bevande !!};

        $.each(obj, function(key,value) {
          number += value.quantitystock;
        });

        $("#db1").html(number);
    var tot = number/500*100;
    $('#desk1').css({'width': tot+'%'});
  });


      $(document).ready(function() {
        var number = 0;
        var obj = {!! $Pizze !!};

        $.each(obj, function(key,value) {

          number += value.quantitystock;
        });

        $("#db2").html(number);
    var tot = number/500*100;
    $('#desk2').css({'width': tot+'%'});
  });

      $(document).ready(function() {
        var number = 0;
        var obj = {!! $Ice_creams !!};

        $.each(obj, function(key,value) {

          number += value.quantitystock;
        });

        $("#db3").html(number);
    var tot = number/500*100;
    $('#desk3').css({'width': tot+'%'});
  });


      $(document).ready(function() {
        var number = 0;
        var obj = {!! $Desk !!};

        $.each(obj, function(key,value) {

          number += value.quantitystock;
        });

        $("#db4").html(number);
    var tot = number/500*100;
    $('#desk4').css({'width': tot+'%'});
  });





</script>
{{-- ANNUAL REPORTING: --}}
<script>

  $(document).ready(function() {

    var month = [[0],[0],[0],[0],[0],[0],[0],[0],[0],[0],[0],[0]];
    var ordersy = {!! $Orders_this_year !!};
    var current_year;

    var tot = 0;
    $.each(ordersy, function(key,value) {
      var y = new Date(value.created_at);

      current_year = y.getFullYear();
      month[y.getMonth()] = [parseInt(month[y.getMonth()])+1];
      tot++;

    });
    $("#thisyear").html(tot);




    //LAST YEAR:
    var monthly = [[0],[0],[0],[0],[0],[0],[0],[0],[0],[0],[0],[0]];
    var ordersly = {!! $Orders_last_year !!};

    var totlast = 0;
    $.each(ordersly, function(key,value) {
      var y = new Date(value.created_at);
      monthly[y.getMonth()] = [parseInt(monthly[y.getMonth()])+1];
      totlast++;
    });
    $("#lastyear").html(totlast);


    $("#salesyear").html("Vendite " + current_year);





  var salesChartCanvas = $('#salesChart').get(0).getContext('2d');

  var salesChartData = {
    labels  : ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio','Agosto','Settembre','Ottobre','Novembre','Dicembre'],
    datasets: [
    {
      label               : "Quest'anno",
      backgroundColor     : '#c2b280',
      borderColor         : '#000',
      pointRadius          : true,
      pointColor          : '#3b8bba',
      pointStrokeColor    : '#c2b280',
      pointHighlightFill  : '#fff',
      pointHighlightStroke: '#c2b280',
      borderWidth: 1.5,
        data                : month
      },
      {
        label               : "Anno precedente",
        backgroundColor     : '#cfd0d2',
        borderColor         : '#000',
        pointRadius          : true,
        pointColor          : '#3b8bba',
        pointStrokeColor    : 'rgba(60,141,188,1)',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        borderWidth: 1.5,
        data                : monthly
      }
      ]
    }

    var salesChartOptions = {

      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: true
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : true,
          }
        }],
        yAxes: [{
          gridLines : {
            display : true,

          }

        }]
      }
    }

  // This will get the first returned node in the jQuery collection.
  var salesChart = new Chart(salesChartCanvas, {
    type: 'bar',
    data: salesChartData,
    options: salesChartOptions
  }
  )





});
</script>

<script>
  //MONTH PRICE

  $(document).ready(function() {
    var month_price = [[0],[0],[0],[0],[0],[0],[0],[0],[0],[0],[0],[0]];
    var ordersy = {!! $Orders_this_year !!};
    var month_pricely = [[0],[0],[0],[0],[0],[0],[0],[0],[0],[0],[0],[0]];
    var ordersly = {!! $Orders_last_year !!};


    $.each(ordersly, function(key,value) {
      var y = new Date(value.created_at);
      current_year = y.getFullYear();

  //PRICE FOR MONTH:
  var json = jQuery.parseJSON(value.id_products);
  $.each(json, function(keys,values) {
    month_pricely[y.getMonth()] = [parseFloat(month_pricely[y.getMonth()]) + (values.price * values.quantity)];
  });

});


    $.each(ordersy, function(key,value) {
      var y = new Date(value.created_at);
      current_year = y.getFullYear();

  //PRICE FOR MONTH:
  var json = jQuery.parseJSON(value.id_products);
  $.each(json, function(keys,values) {
    month_price[y.getMonth()] = [parseFloat(month_price[y.getMonth()]) + (values.price * values.quantity)];
  });

});

    var ticksStyle = {
      fontColor: '#495057',
      fontStyle: 'bold'
    }
    var mode = 'index';
    var intersect = true;

    var $visitorsChart = $('#visitors-chart')
    var visitorsChart  = new Chart($visitorsChart, {
      data   : {
        labels  : ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio','Agosto','Settembre','Ottobre','Novembre','Dicembre'],
        datasets: [{
          type                : 'line',
          data                : month_price,
          backgroundColor     : 'transparent',
          borderColor         : '#c2b280',
          pointBorderColor    : '#000',
          pointBackgroundColor: '#000',
          fill                : false
        // pointHoverBackgroundColor: '#007bff',
        // pointHoverBorderColor    : '#007bff'
      },
      {
        type                : 'line',
        data                : month_pricely,
        backgroundColor     : 'tansparent',
        borderColor         : '#ced4da',
        pointBorderColor    : '#ced4da',
        pointBackgroundColor: '#ced4da',
        fill                : false
          // pointHoverBackgroundColor: '#ced4da',
          // pointHoverBorderColor    : '#ced4da'
        }]
      },
      options: {
        maintainAspectRatio: false,
        tooltips           : {
          mode     : mode,
          intersect: intersect
        },
        hover              : {
          mode     : mode,
          intersect: intersect
        },
        legend             : {
          display: false
        },
        scales             : {
          yAxes: [{
          // display: false,
          gridLines: {
            display      : true,
            lineWidth    : '4px',
            color        : 'rgba(0, 0, 0, .2)',
            zeroLineColor: 'transparent'
          },
          ticks    : $.extend({
            beginAtZero : true,
            suggestedMax: 200
          }, ticksStyle)
        }],
        xAxes: [{
          display  : true,
          gridLines: {
            display: false
          },
          ticks    : ticksStyle
        }]
      }
    }
  })
  });
</script>


@stop




