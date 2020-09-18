@extends('adminlte::page')

@section('title', 'Order')

@section('content_header')
<h1>CRUD User</h1>
@stop

@section('content')
@include('layouts.alert')

@if ($errors->any())
<div class="alert alert-danger">
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif

<div class="row">
  <!-- 1 -->   
  <div class="col-sm-4">

    <form id="registeruser" class="px-2 py-2" action="{{ route('user.store') }}" method="POST">
      @csrf
      <div class="form-group"><br>
        <label>Create</label><br>
        <input type="text" class="form-control" required="" name="name" placeholder="name">
        <input type="text" class="form-control" required="" name="surname" placeholder="surname">
      </div>
      <div class="form-group">
        <input type="email" class="form-control" required="" name="email" placeholder="email@example.com">
      </div>

      <div class="form-group" style="text-align: center;">
        Choose umbrella, or not: <br>
        <select id="umbrella" name="umbrella">

          <option selected="" value="">Null</option>
          @foreach ($umbrellas as $umbrella)
          <option value="{{ $umbrella->id }}">{{ $umbrella->id }}</option>
          @endforeach

        </select>
      </div>

      <div id="insertdate" style='text-align: center; visibility: hidden;'>
        inizio:<input id="dateinputdal" name='dateinputdal' placeholder="Insert date" type='text' /><br>
        fine:<input id="dateinputal" name='dateinputal' placeholder="insert date" type='text'/>
        
      </div>
      <button type="submit" style="float: right;" class="btn btn-primary">Create</button>
    </form>

  </div>

  <!-- 2 -->
  <div class="col-sm-4">
    <br>
    @php
    $prova = 0;
    @endphp

    <form id="showuser" class="px-2 py-2" action="{{ route('user.show','') }}" onsubmit="$().showuser();" method="POST">
      @method('GET')
      @csrf
      <div class="form-group">
        <label>Show / Update</label><br>
        <input type="number" class="form-control"min="1" id="iduser" name="iduser" placeholder="Insert id user">
      </div>
      <button type="submit" style="float: right;" class="btn btn-primary">Show</button>
    </form>

  </div>
  <!-- 3 -->
  <div class="col-sm-4">


    <br>

    <form id="deleteuser" class="px-2 py-2" action="{{ route('user.destroy','') }}" method="POST" >
      @method('DELETE')
      @csrf
      <div class="form-group">
        <label>Delete</label><br>
        <input type="number" class="form-control" min="1" id="iduserdelete" name="iduserdelete" placeholder="Insert id user">
      </div>
      <button type="submit" style="float: right;" id="buttondelete" class="btn btn-primary">Delete</button>
    </form>

  </div>
</div>
</div> 
<br>


{{-- 
<div class="row">
  <div class="col-sm-8">

    <div id="chartDiv" style="width: 700px;height: 220px;margin: 0px auto"></div>

  </div>

  --}}
  @stop

  @section('css')
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
  @stop

  @section('js')
  @include('construct.badgeorder')
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <script
  src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"
  integrity="sha256-0YPKAwZP7Mp3ALMRVB2i8GXeEndvCq3eSl/WsAl1Ryk="
  crossorigin="anonymous"></script>
  {{-- <script src="{{ asset('node_modules\axios\dist\axios.js') }}"></script> --}}


  <script type="text/javascript">
    $( document ).ready(function() {
      $("#registeruser").trigger("reset");
      $("#deleteuser").trigger("reset");
      $("#showuser").trigger("reset");
    });

    $('#umbrella').on('input', function() { 
      $val = $(this).val();
      if ($val != '') {

        $('#insertdate').css("visibility","visible");
        $("#dateinputdal").prop('required',true);
        $("#dateinputal").prop('required',true);

      //prendo l'id dell'ombrellone
      $idumbrella = $('#umbrella').val();
      //console.log($idumbrella);
      //const axios = require('axios');
      axios.get('/admin/beachumbrellaresult/'+ $idumbrella, {


      }).then(response => {
        //console.log(response);

          
          // array to hold the range
          dateRange = [];
          //devo usare l'array adesso:
          
          $.each(response, function(key,value) {
            $.each(value.subs, function(keys,values) {
              //console.log(values.id);
              //console.log(values.from);
              //console.log(values.to);

              // populate the array
              for (var d = new Date(values.from); d <= new Date(values.to); d.setDate(d.getDate() + 1)) {
                dateRange.push($.datepicker.formatDate('yy-mm-dd', d));
              }

            });
          });
          
          $('dateinputdal').datepicker('setDate', null);
          $('dateinputal').datepicker('setDate', null);
          $('#dateinputdal').datepicker({

            // use this array 
            beforeShowDay: function (date) {
              var dateString = jQuery.datepicker.formatDate('yy-mm-dd', date);
              return [dateRange.indexOf(dateString) == -1];
            }

          });

          $('#dateinputal').datepicker({

            // use this array 
            beforeShowDay: function (date) {
              var dateString = jQuery.datepicker.formatDate('yy-mm-dd', date);
              return [dateRange.indexOf(dateString) == -1];
            }

          });
          


        }).catch(function (error) {

          console.log(error)

        });




{{-- 


disabilitare la singola data
var unavailableDates = ["9-9-2020"];
        function unavailable(date) {
          dmy = date.getDate() + "-" + (date.getMonth()+1) + "-" + date.getFullYear();
          if ($.inArray(dmy, unavailableDates) < 0) {
            return [true,"","Book Now"];
          } else {
            return [false,"","Booked Out"];
          }
        }

        $('#dateinputdal').datepicker({beforeShowDay: unavailable});



//INIZIO LAVORO SUL CALENDAR
        var minDate = new Date();
        var startDate = "2020-07-10", // some start date
        endDate  = "2020-09-09",  // some end date
        dateRange = [];           // array to hold the range

        // populate the array
        for (var d = new Date(startDate); d <= new Date(endDate); d.setDate(d.getDate() + 1)) {
          dateRange.push($.datepicker.formatDate('yy-mm-dd', d));
        }

        $("#dateinputdal").datepicker({
          changeYear: false,
          showAnim: 'drop',
          minDate:minDate,
          dateFormat:'dd/mm/yy',


        // use this array 
        beforeShowDay: function (date) {
            var dateString = jQuery.datepicker.formatDate('yy-mm-dd', date);
            return [dateRange.indexOf(dateString) == -1];
          }


      });

      --}}




    }
    else{
      $('#insertdate').css("visibility","hidden");
      $('#insertdate').css("visibility","hidden");
      $("#datedal").prop('required',false);
      $("#dateal").prop('required',false);
      $('#datedal').val('');
      $('#dateal').val('');

    }


  });

</script>







<script>
  //Show
  var linkbasic = $("#showuser").attr("action");
  //console.log(linkbasic);
  (function( $ ){
   $.fn.showuser = function() {
    var id = $("#iduser").val();
    $ciao = $("#showuser").attr("action",linkbasic+"/"+id);

  }; 
})( jQuery );

</script>

<script>
  //Delete
  var linkbasic2 = $("#deleteuser").attr("action");
  //console.log(linkbasic2);
  $('#buttondelete').click(function() {
    var id = $("#iduserdelete").val();

    if (id != 0 && id != '' && confirm('Delete this user ?')) {
      $ciao = $("#deleteuser").attr("action",linkbasic2+"/"+id);
      return true;
    }
    else{
      return false;
    }
  });

</script>

{{-- DataPicker --}}
<script type="text/javascript"></script>


















{{-- Calendar year: <script src="https://code.jscharting.com/latest/jscharting.js"></script> --}}
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">

      /*
      
       
var chart, 
  chartConfig = { 
    debug: true, 
    type: 'calendar year solid', 
    title: { 
      label: { 
        text: 'Subscription of Umbrella', 
        style_fontSize: 14 
      }, 
      position: 'center'
    }, 
    legend: { 
      position: 'bottom', 
      template: '%name'
    }, 
    calendar: { 
      range: ['1/1/2018', '12/31/2018'], 
      defaultEmptyPoint: { tooltip: '%name' } 
    }, 
    defaultSeries: { 
      shape_innerPadding: 0, 
      defaultPoint_tooltip: '%name'
    }, 
    toolbar_visible: false
  }; 
  

  chart = JSC.chart('chartDiv',chartConfig); 
  */
 /*
 
 , 
    function(c) { 
      //This timeout will ensure the chart is rendered before processing additional year. 
      setTimeout(function() { 
        c.options({ 
          calendar: { 
            range: ['1/1/2020', '1/1/2021'] 
          } 
        }); 
      }, 200); 
    } 

    */


  </script>


  @stop