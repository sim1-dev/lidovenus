@extends('adminlte::page')

@section('title', 'Order')

@section('content_header')
<h1>Create Order</h1>
@stop

@section('content')
@include('layouts.alert')

<div class="container text-center" style="background-color: #fff;width: auto;">
  <h4>Choose product :</h4>
  <form action="{{ route('createorder.store') }}" method="POST" name="insertorder">
    @csrf
    &nbsp;


    <select class="form-control" required="" name="users" id="users">
      <option value="">Select User</option>
      @foreach ($users as $element)
      <option value="{{ $element->id }}">{{ $element->name }}</option>
      @endforeach
    </select>


    <select class="form-control" required="" name="umbrella" id="umbrella">
      <option value="">Umbrella</option>
      @foreach ($umbrellas as $element)
      <option value="{{ $element->id }}">{{ $element->id }}</option>
      @endforeach
    </select>


    <select class="form-control" required="" name="product" id="product">
      <option value="">Select product</option>
      @foreach ($products as $element)
      <option value="{{ $element->id }}">{{ $element->name }}</option>
      @endforeach
    </select>


    <!-- In base a cosa seleziono sulla select product_id_name -->
    <select class="form-control" required="" name="quantity" id="quantity">
      <option value="">Quantity</option>
    </select>



    <br>
    <small>Choose another product or not :</small><br>
    &nbsp;

    <select class="form-control" name="product2" id="product2">
      <option value="">Select product</option>
      @foreach ($products as $element)
      <option value="{{ $element->id }}">{{ $element->name }}</option>
      @endforeach
    </select>

    <!-- In base a cosa seleziono sulla select product_id_name -->
    <select class="form-control" name="quantity2" id="quantity2">
      <option value="">Quantity</option>
    </select>



    <br>
    <br>
    <input type="submit" class="btn btn-primary" name="create" id="create" value="Create">
  </form>

</div>





@stop

@section('css')

@stop

@section('js')
@include('construct.badgeorder')

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script type="text/javascript">
  $( document ).ready(function() {
    //resetto tutti i pulsanti
    $("#insertorder").trigger("reset");
    $("#product").val("");
    $("#product2").val("");

  });

  $("#product").change(function(){
    $val = $(this).val();
    //console.log($val);
    if ($val != '') {
      $idproduct = $('#product').val();
      axios.get('/admin/createorder/'+ $idproduct, {
      }).then(response => {
        //console.log(response.data.product);
        $quantity = response.data.product.quantitystock;
        for (var i = 0; i < $quantity; i++) {
          var tot = parseInt(i) + 1;
          $('#quantity').append('<option value='+tot+'>'+tot+'</option>');
        }
        //console.log(response);
      }).catch(function (error) {

        console.log(error);

      });
    }
  })


  $("#product2").change(function(){
    $val = $(this).val();
    //console.log($val);
    if ($val != '') {
      $("#product2").prop('required',true);
      $("#users2").prop('required',true);
      $("#quantity2").prop('required',true);
      $("#umbrella2").prop('required',true);

      $idproduct = $('#product2').val();
      axios.get('/admin/createorder/'+ $idproduct, {
      }).then(response => {
        console.log(response.data.product);
        $quantity = response.data.product.quantitystock;
        for (var i = 0; i < $quantity; i++) {
          var tot = parseInt(i) + 1;
          $('#quantity2').append('<option value='+tot+'>'+tot+'</option>');
        }
        //$('#quantity').append('<option value="test1">test1</option>');
        console.log(response);
      }).catch(function (error) {

        console.log(error);

      });
    }else{
      $("#product2").prop('required',false);
      $("#users2").prop('required',false);
      $("#quantity2").prop('required',false);
      $("#umbrella2").prop('required',false);

      $("#product2").val("");
      $("#users2").val("");
      $("#quantity2").val("");
      $("#umbrella2").val("");
    }
  })


  $('#create').click(function() {
    var prod1 = $("#product").val();
    var prod2 =$("#product2").val();
    if (prod1 != prod2) {
      return true;
    }
    else{
      window.alert("hai selezionato lo stesso prodotto");
      return false;
    }
  });
</script>
@stop
