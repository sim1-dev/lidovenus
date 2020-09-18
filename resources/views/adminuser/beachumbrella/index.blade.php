@extends('adminlte::page')

@section('title', 'Order')

@section('content_header')
<h1>CRUD Umbrella</h1>
@stop

@section('content')
@include('layouts.alert')

<div class="row">
  <!-- 1 -->
  <div class="col-sm-4">

    <form id="registerumbrella" class="px-2 py-2" action="{{ route('beachumbrella.store') }}" method="POST">
      @csrf
      <div class="form-group"><br>
        <label>Create</label><br>
        <select class="form-control" name="type">
          <option value="normal umbrella">normal umbrella</option>
          <option value="big umbrella">big umbrella</option>
        </select>
      </div>
      <button type="submit" style="float: right;" class="btn btn-primary">Create</button>
    </form>

  </div>

<!-- 2 -->
  <div class="col-sm-4">
    <br>
   <form id="showumbrella" class="px-2 py-2" action="{{ route('beachumbrella.show','') }}" method="GET" onsubmit="$().showumbrella();">
      <div class="form-group">
        <label>Show / Update</label><br>
        <input type="text" class="form-control" id="idumbrella" placeholder="Insert id umbrella">
      </div>
      <button type="submit" style="float: right;" class="btn btn-primary">Show</button>
    </form>
  </div>
  <!-- 3 -->
  <div class="col-sm-4">

  <br>
   <form id="deleteumbrella" class="px-2 py-2" action="{{ route('beachumbrella.destroy','') }}" method="POST">
      @method('DELETE')
      @csrf
      <div class="form-group">
        <label>Delete</label><br>

        <input type="text" class="form-control" min="1" id="idumbrelladelete" name="idumbrelladelete" placeholder="Insert id umbrella">
      </div>
      <button id="buttonumbrelladelete" type="submit" style="float: right;" class="btn btn-primary">Delete</button>
    </form>
  </div>
</div>
</div>
<br>

<div class="row">

</div>








@stop

@section('css')

<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@include('construct.badgeorder')

<script type="text/javascript">
  $( document ).ready(function() {
    $("#registerumbrella").trigger("reset");
    $("#deleteumbrella").trigger("reset");
    $("#showumbrella").trigger("reset");
  });

</script>

<script>
  //Show
  var linkbasic = $("#showumbrella").attr("action");
  //console.log(linkbasic);
  (function( $ ){
   $.fn.showumbrella = function() {
    var id = $("#idumbrella").val();
    $ciao = $("#showumbrella").attr("action",linkbasic+"/"+id);

  };
})( jQuery );

</script>

<script>
  //Delete
  var linkbasic2 = $("#deleteumbrella").attr("action");
  //console.log(linkbasic2);
  $('#buttonumbrelladelete').click(function() {
    var id = $("#idumbrelladelete").val();

    if (id != 0 && id != '' && confirm('Delete this umbrella ?')) {
      $ciao = $("#deleteumbrella").attr("action",linkbasic2+"/"+id);
      return true;
    }
    else{
      return false;
    }
  });





  </script>

@stop
