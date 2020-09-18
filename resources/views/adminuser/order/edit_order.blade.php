@extends('adminlte::page')

@section('title', 'Order')

@section('content_header')
<h1>Edit Order</h1>
@stop

@section('content')
<section class="content">
  <div class="container-fluid">
    @include('layouts.alert')
  </div>

{{-- v-bind:cartorder="{{ $cart }}" cart_total="{{ $cart_total }}" --}}
  <div id="app">
    <formproduct  orderid="{{ $orderid }}" delivered="{{ $delivered }}" token="{{ csrf_token() }}"></formproduct>
  </div>


</section>

@stop

@section('css')

<!-- <link rel="stylesheet" href="/css/admin_custom.css"> -->
@stop

@section('js')
@include('construct.badgeorder')

<script src="{{ mix('js/app.js') }}"></script>

<script type="text/javascript">
  $( document ).ready(function() {
    
});
</script>

@stop




  {{-- 
<div class="container" style="background-color: #fff;width: auto;">

 <form id="updateorder" class="px-2 py-2" action="">
  @csrf
  <div class="form-group"><br>

    <label>Id</label><br>
    <input type="text" class="form-control" disabled name="id" placeholder="id" value="{{ $order->id }}">
    <label>Created_at</label><br>
    <input type="text" class="form-control" disabled name="created_at" placeholder="id" value="{{ $order->created_at }}">
    <label>Update_at</label><br>
    <input type="text" class="form-control" disabled name="created_at" placeholder="id" value="{{ $order->created_at }}">
    <label>Umbrella</label><br>
    @foreach ($order->umbrellas as $element)
        <input class="form-control" disabled value="{{ $element->id }}">
      @endforeach
  </div>
  <div class="form-group">
    <label>Delivered</label><br>
    <input type="number" class="form-control" required="" min="0" max="1" value="{{ $order->delivered }}" name="delivered" placeholder="email@example.com">
  </div>
  <div class="form-group" style="text-align: center;">
    <label>Prodotti</label><br>

    <table class="table" style="text-align: center;">
    <thead>
      <tr role="row">
        <th>Name:</th>
        <th>Quantity:</th>
        <th>Price:</th>
      </tr>
    </thead>
    <tbody>
      @php
      $items = json_decode($order->id_products);
      $pricetotal = 0;
      @endphp
      @foreach ($items as $key=>$value)

      <td style="width:40%;">{{ $value->name }} ({{ $value->price }})</td>
      <td style="width:40%;">{{ $value->quantity }}</td>
      <td style="width:20%;">
        @php
        $a = $value->quantity;
        $b = $value->price;
        $c = $a * $b;
        $pricetotal += $c;
        @endphp
        {{ $c }}
        
      </td>

      @endforeach
      
    </tbody>
  </table>

  </div>
  <div class="form-group" style="float: right;">
    <input type="submit" name="Aggiorna" value="Aggiorna">

  </div>
</form>
</div>











<br>



<script>

      $(document).ready(function(){

        $.fn.searchproduct = function($search){ 
          console.log($search);
          $.ajax({
            type: 'post',
            url: '{{ route('searchproduct') }}',
            data: {
              '_token': $('input[name=_token]').val(),
              'searchproduct': $search
            },
            success: function(search) {
              console.log(search);

            },
          });

        }

      });


    </script>

   --}}