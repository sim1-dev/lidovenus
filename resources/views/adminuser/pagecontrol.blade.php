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
          <a href="#" class="small-box-footer">
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
          <a href="#" class="small-box-footer">
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
          <a href="#" class="small-box-footer">
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

                <!-- Destra di annual reporting -->
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
        <div class="row">
          <!-- Left col -->
          <div class="col-md-8">
            <!-- MAP & BOX PANE -->
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Monitor Sales with Price</h3>
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
                  <i class="fas fa-square text-green"></i> This Year
                </span>

                <span>
                  <i class="fas fa-square text-gray"></i> Last Year
                </span>
              </div>
            </div>
          </div>
          

          <!-- TABLE: LATEST ORDERS -->
          <div class="card collapsed-card">
            <div class="card-header border-transparent">
              <h3 class="card-title">Latest Orders</h3>

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
                    <tr>
                      <td><a href="pages/examples/invoice.html">OR9842</a></td>
                      <td>Call of Duty IV</td>
                      <td><span class="badge badge-success">Shipped</span></td>
                      <td>
                        <div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div>
                      </td>
                    </tr>
                    <tr>
                      <td><a href="pages/examples/invoice.html">OR1848</a></td>
                      <td>Samsung Smart TV</td>
                      <td><span class="badge badge-warning">Pending</span></td>
                      <td>
                        <div class="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70,61,-83,68</div>
                      </td>
                    </tr>
                    <tr>
                      <td><a href="pages/examples/invoice.html">OR7429</a></td>
                      <td>iPhone 6 Plus</td>
                      <td><span class="badge badge-danger">Delivered</span></td>
                      <td>
                        <div class="sparkbar" data-color="#f56954" data-height="20">90,-80,90,70,-61,83,63</div>
                      </td>
                    </tr>
                    <tr>
                      <td><a href="pages/examples/invoice.html">OR7429</a></td>
                      <td>Samsung Smart TV</td>
                      <td><span class="badge badge-info">Processing</span></td>
                      <td>
                        <div class="sparkbar" data-color="#00c0ef" data-height="20">90,80,-90,70,-61,83,63</div>
                      </td>
                    </tr>
                    <tr>
                      <td><a href="pages/examples/invoice.html">OR1848</a></td>
                      <td>Samsung Smart TV</td>
                      <td><span class="badge badge-warning">Pending</span></td>
                      <td>
                        <div class="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70,61,-83,68</div>
                      </td>
                    </tr>
                    <tr>
                      <td><a href="pages/examples/invoice.html">OR7429</a></td>
                      <td>iPhone 6 Plus</td>
                      <td><span class="badge badge-danger">Delivered</span></td>
                      <td>
                        <div class="sparkbar" data-color="#f56954" data-height="20">90,-80,90,70,-61,83,63</div>
                      </td>
                    </tr>
                    <tr>
                      <td><a href="pages/examples/invoice.html">OR9842</a></td>
                      <td>Call of Duty IV</td>
                      <td><span class="badge badge-success">Shipped</span></td>
                      <td>
                        <div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
              <a href="javascript:void(0)" class="btn btn-sm btn-info float-left">Place New Order</a>
              <a href="javascript:void(0)" class="btn btn-sm btn-secondary float-right">View All Orders</a>
            </div>
            <!-- /.card-footer -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->

        <div class="col-md-4">
          <!-- USERS LIST -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Latest Members</h3>

              <div class="card-tools">
                <span class="badge badge-danger">8 New Members</span>
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <ul class="users-list clearfix">
                <li>
                  <img src="dist/img/user1-128x128.jpg" alt="User Image">
                  <a class="users-list-name" href="#">Alexander Pierce</a>
                  <span class="users-list-date">Today</span>
                </li>
                <li>
                  <img src="dist/img/user8-128x128.jpg" alt="User Image">
                  <a class="users-list-name" href="#">Norman</a>
                  <span class="users-list-date">Yesterday</span>
                </li>
                <li>
                  <img src="dist/img/user7-128x128.jpg" alt="User Image">
                  <a class="users-list-name" href="#">Jane</a>
                  <span class="users-list-date">12 Jan</span>
                </li>
                <li>
                  <img src="dist/img/user6-128x128.jpg" alt="User Image">
                  <a class="users-list-name" href="#">John</a>
                  <span class="users-list-date">12 Jan</span>
                </li>
                <li>
                  <img src="dist/img/user2-160x160.jpg" alt="User Image">
                  <a class="users-list-name" href="#">Alexander</a>
                  <span class="users-list-date">13 Jan</span>
                </li>
                <li>
                  <img src="dist/img/user5-128x128.jpg" alt="User Image">
                  <a class="users-list-name" href="#">Sarah</a>
                  <span class="users-list-date">14 Jan</span>
                </li>
                <li>
                  <img src="dist/img/user4-128x128.jpg" alt="User Image">
                  <a class="users-list-name" href="#">Nora</a>
                  <span class="users-list-date">15 Jan</span>
                </li>
                <li>
                  <img src="dist/img/user3-128x128.jpg" alt="User Image">
                  <a class="users-list-name" href="#">Nadia</a>
                  <span class="users-list-date">15 Jan</span>
                </li>
              </ul>
              <!-- /.users-list -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer text-center">
              <a href="javascript::">View All Users</a>
            </div>
            <!-- /.card-footer -->
          </div>
          <!--/.card -->




          <!-- inventory last -->
          <div class="card">


            <div class="card-header">
              <h3 class="card-title">Inventory</h3>

              <div class="card-tools">
                <span class="badge badge-danger">8 New Members</span>
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                </button>
              </div>
            </div>

            

            <div class="progress-group">
              Drinks
              <span class="float-right"><b id="db1"></b></span>
              <div class="progress progress-sm">
                <div class="progress-bar bg-primary" id="desk1"></div>
              </div>
            </div>
            <!-- /.progress-group -->

            <div class="progress-group">
              Pizzas
              <span class="float-right"><b id="db2"></b></span>
              <div class="progress progress-sm">
                <div class="progress-bar bg-danger" id="desk2"></div>
              </div>
            </div>

            <!-- /.progress-group -->
            <div class="progress-group">
              <span class="progress-text">Ice creams</span>
              <span class="float-right"><b id="db3"></b></span>
              <div class="progress progress-sm">
                <div class="progress-bar bg-success" id="desk3"></div>
              </div>
            </div>

            <!-- /.progress-group -->
            <div class="progress-group">
              Sandwich
              <span class="float-right"><b id="db4"></span>
                <div class="progress progress-sm">
                  <div class="progress-bar bg-warning" id="desk4"></div>
                </div>
              </div>
              <!-- /.progress-group -->

              <!-- /.col -->
            </div>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        <!--/. container-fluid -->
      </section>


      <p>
      @php /*
    $a = json_decode($Orders_this_year->first()->id_products,true);
    //print_r($a);
    foreach ($a as $key => $value) {
     echo '<br><br><br>';
     var_dump($key);
     foreach ($value as $keys => $values) {
      echo '<br><br><br>';
      var_dump($keys);

     }
    }
*/
    @endphp

  </p>

    <p>{{--  @foreach ($Orders_this_year as $element)
      {{ $element->id_products }} <br><br>
    @endforeach--}}</p>

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
        {{-- var ciao = {!! json_encode($Pizzas->toArray()) !!}; --}}
        {{-- $("i:eq(0)").text($.inArray("Jupiter", planets)); // search array for Jupiter --}}
        var number = 0;
        var obj = {!! $Drinks !!};

        $.each(obj, function(key,value) {
          //console.log(value.name);
          number += value.quantitystock;
        });

        $("#db1").html(number);
    //$("#db2").attr("value", number);
    var tot = number/500*100;
    $('#desk1').css({'width': tot+'%'});
  });


      $(document).ready(function() {
        var number = 0;
        var obj = {!! $Pizzas !!};

        $.each(obj, function(key,value) {

          number += value.quantitystock;
        });

        $("#db2").html(number);
    //$("#db2").attr("value", number);
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
    //$("#db2").attr("value", number);
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
    //$("#db2").attr("value", number);
    var tot = number/500*100;
    $('#desk4').css({'width': tot+'%'});
  });



      

</script>
{{-- ANNUAL REPORTING: --}}
<script>

  $(document).ready(function() {

    var month = [[0],[0],[0],[0],[0],[0],[0],[0],[0],[0],[0],[0]];
    var ordersy = {!! $Orders_this_year !!};
    var current_year;//variabile per la scritta Sales 2020

    var tot = 0;
    $.each(ordersy, function(key,value) {
      var y = new Date(value.created_at);

      current_year = y.getFullYear();//variabile per la scritta Sales 2020
      //console.log(y.getMonth());
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
      //console.log(y.getMonth());
      monthly[y.getMonth()] = [parseInt(monthly[y.getMonth()])+1];
      totlast++;
    });
    $("#lastyear").html(totlast);


    $("#salesyear").html("Vendite " + current_year);


  //console.log(monthly);



  var salesChartCanvas = $('#salesChart').get(0).getContext('2d');

  var salesChartData = {
    labels  : ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio','Agosto','Settembre','Ottobre','Novembre','Dicembre'],
    datasets: [
    {
      label               : "Quest'anno",
      backgroundColor     : '#5f9b1b',
      borderColor         : '#000',
      pointRadius          : true,
      pointColor          : '#3b8bba',
      pointStrokeColor    : 'rgba(60,141,188,1)',
      pointHighlightFill  : '#fff',
      pointHighlightStroke: 'rgba(60,141,188,1)',
      borderWidth: 1.5,
        data                : month//intervallo valori
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
        data                : monthly//intervallo valori
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
          borderColor         : 'green',
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




