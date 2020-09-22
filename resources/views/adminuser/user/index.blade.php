@extends('adminlte::page')

@section('title', 'Order')

@section('content_header')
<h1 class="mb-4"><b>Utenti</b></h1>
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
  <div class="col-md-6">

    <form id="registeruser" class="px-2 py-2" action="{{ route('user.store') }}" method="POST">
      @csrf
      <div class="form-group mb-4">
        <h4><b>Crea utente</b></h4>
        <input type="text" class="form-control w-50 float-left" required="" name="name" placeholder="Nome">
        <input type="text" class="form-control w-50 float-left" required="" name="surname" placeholder="Cognome">
      </div>
      <div class="form-group" style="padding-top:38px;padding-bottom:59px">
        <input type="email" class="form-control w-50 float-left" required="" name="email" placeholder="E-mail">
        <input type="password" class="form-control w-50 float-left" required="" name="password" placeholder="Password">
      </div>

      <div class="form-group text-left">
        <h5><b>Assegna ombrellone</b></h5>
        <select class="form-control" id="umbrella" name="umbrella">

          <option selected="" value="">Nessun ombrellone</option>
          @foreach ($umbrellas as $umbrella)
          <option value="{{ $umbrella->id }}">Ombrellone {{ $umbrella->id }} - {{ $umbrella->type }} </option>
          @endforeach

        </select>

      </div>

      <div id="insertdate" style='visibility: hidden;'>
        <div class="container-fluid my-2 p-0">
          <label class="float-left w-50">Data Inizio:</label>
          <label class="float-left w-50">Data Fine:</label>
        </div>
        <div class="container-fluid p-0">
          <input class="form-control w-50 float-left" id="dateinputdal" name='dateinputdal' placeholder="Data inizio" type='text' /><br>
          <input class="form-control w-50 float-left" id="dateinputal" name='dateinputal' placeholder="Data fine" type='text'/>
      </div>
      </div>
      <button type="submit" class="btn btn-primary w-100 mt-3">CREA UTENTE</button>
    </form>

  </div>

  <!-- 2 -->
  <div class="col-md-6">
    @php
    $prova = 0;
    @endphp

    <form id="showuser" class="px-2 py-2" action="{{ route('user.show','') }}" onsubmit="$().showuser();" method="POST">
      @method('GET')
      @csrf
      <div class="form-group">
        <h4><b>Visualizza utente</b></h4>
        <input type="number" class="form-control"min="1" id="iduser" name="iduser" placeholder="Inserisci ID Utente">
      </div>
      <button type="submit" class="btn btn-success w-100">VISUALIZZA UTENTE</button>
    </form>

    <form id="deleteuser" class="px-2 py-2" action="{{ route('user.destroy','') }}" method="POST" >
      @method('DELETE')
      @csrf
      <div class="form-group" style="padding-top:22px;padding-bottom:86px">
        <h5><b>Elimina utente</b></h5>
        <input type="number" class="form-control" min="1" id="iduserdelete" name="iduserdelete" placeholder="Inserisci ID Utente">
      </div>
      <button type="submit" id="buttondelete" class="btn btn-danger w-100">ELIMINA UTENTE</button>
    </form>

  </div>

</div>
</div>
<br>

<h4 class="my-4"><b>Lista Utenti</b></h4>

<table class="table table-striped">
    <thead class="table-dark">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nome</th>
        <th scope="col">Cognome</th>
        <th scope="col">Email</th>
        <!--<th scope="col">Azioni</th>-->
      </tr>
    </thead>
    <tbody>
    @foreach ($users as $user)
      <tr>
        <th scope="row">{{ $user->id }}</th>
        <td>{{ $user->name }}</td>
        <td>{{ $user->surname }}</td>
        <td>{{ $user->email }}</td>
    {{--    <td>
          <form id="showuser" onsubmit="$().showuser();" action="{{ route('user.show','') }}" method="POST">
            @method('GET')
            @csrf
            <input type="number" hidden class="form-control w-50 float-left"id="iduser" name="iduser" placeholder="{{ $user->id }}">
            <button type="submit" class="btn btn-success">Visualizza</button>
            </form>
            <form id="deleteuser" action="{{ route('user.destroy','') }}" method="POST">
            @method('DELETE')
            @csrf
            <input type="number" hidden class="form-control w-50 float-left" id="iduserdelete" name="iduserdelete" placeholder="{{ $user->id }}">
            <button type="submit" class="btn btn-danger">Elimina</button>
            </form>
        </td>
      --}}
      </tr>
    @endforeach
    </tbody>
  </table>

  <div class="d-flex justify-content-center">
    {{ $users->links() }}
</div>

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

      $idumbrella = $('#umbrella').val();
      axios.get('/admin/beachumbrellaresult/'+ $idumbrella, {


      }).then(response => {

          dateRange = [];

          $.each(response, function(key,value) {
            $.each(value.subs, function(keys,values) {
              for (var d = new Date(values.from); d <= new Date(values.to); d.setDate(d.getDate() + 1)) {
                dateRange.push($.datepicker.formatDate('yy-mm-dd', d));
              }

            });
          });

          $('dateinputdal').datepicker('setDate', null);
          $('dateinputal').datepicker('setDate', null);
          $('#dateinputdal').datepicker({


            beforeShowDay: function (date) {
              var dateString = jQuery.datepicker.formatDate('yy-mm-dd', date);
              return [dateRange.indexOf(dateString) == -1];
            }

          });

          $('#dateinputal').datepicker({


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



        var minDate = new Date();
        var startDate = "2020-07-10",
        endDate  = "2020-09-09",
        dateRange = [];

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

    if (id != 0 && id != '' && confirm('Sei sicuro di voler eliminare questo utente?')) {
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
