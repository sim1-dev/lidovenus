@extends('adminlte::page')

@section('title', 'Order')

@section('content_header')
<h1>CRUD Product</h1>
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

   <form id="registeruser" class="px-2 py-2" enctype="multipart/form-data" action="{{ route('product.store') }}" method="POST">
    @csrf
    <label>Create</label>
    <div class="form-group">
      <label>Name:</label><br>
      <input type="text" class="form-control"  name="name" placeholder="name" >
    </div>

    <div class="form-group">
      Insert Image:<br>
      <input type="file" name="image" />
    </div>

    <div class="form-group">
      Category:<br>
      <select class="form-control" name="category">
        @php
        $category = ['Drinks','Ice creams','Pizzas','Desk'];
        @endphp
        @foreach ($category as $element)
        <option value="{{ $element }}">{{ $element }}</option>
        @endforeach
      </select>
    </div>

    <label>Price:</label>
    <div class="form-group">
      <input type="number" class="form-control" step="0.01" name="price" placeholder="price" >
    </div>

    <label>Description:</label>
    <div class="form-group">
      <textarea class="form-control" name="description" placeholder="description"></textarea>
    </div>

    <label>Quantitystock:</label>
    <div class="form-group">
      <input type="number"  class="form-control" min="0" value="0" name="quantitystock" placeholder="quantitystock" >
    </div>

    <label>Brand:</label>
    <div class="form-group">
      <select class="form-control" name="brand">
        @foreach ($brand as $element)
          <option value="{{ $element->id }}">{{ $element->name }}</option>
        @endforeach

      </select>
    </div>




    <button type="submit" style="float: right;" class="btn btn-primary">Create</button>
  </form>

</div>

<!-- 2 -->
<div class="col-sm-4">
  <br>
  <form id="showumbrella" class="px-2 py-2" action="{{ route('product.show','') }}" method="GET" onsubmit="$().showumbrella();">
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
  <form id="deleteumbrella" class="px-2 py-2" action="{{ route('product.destroy','') }}" method="POST">
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

    if (id != 0 && id != '' && confirm('Delete this product ?')) {
      $ciao = $("#deleteumbrella").attr("action",linkbasic2+"/"+id);
      return true;
    }
    else{
      return false;
    }
  });





</script>

@stop
