@extends('adminlte::page')

@section('title', 'Order')

@section('content_header')
<h1>Order</h1>
@stop

@section('content')


<div class="container" style="background-color: #fff;width: auto;">
  <p> Id ordine: {{ $order->id }}</p>
  <hr>

  @foreach ($order->umbrellas as $element)
  <p> Umbrella: {{ $element->id }}</p>
  @endforeach
  <hr>

  @foreach ($order->users as $element)
  <p> User id: {{ $element->id }}</p>
  @endforeach

  <hr>
  <p>Status:
    @if ($order->delivered)
    Consegnato
    @else
    Non consegnato
    @endif

  </p>
  <hr>
  <p> Timestamp {{ $order->created_at}}</p>
  <table class="table" style="text-align: center;">


    <label>Products number:</label>
    <thead>
      <tr role="row">
        <th>Id Product:</th>
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
      <tr>
        <td style="width:40%;">
          <a href="{{ route('product.show', $value->id ) }}">{{ $value->id }}</a>
        </td>
        <td style="width:40%;">{{ $value->name }}</td>
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
      </tr>
      @endforeach

    </tbody>
  </table>
  <label>Totale: {{ $pricetotal }} €</label><br><br>

  @if (!$order->delivered)
  <a class="btn btn-light" style="float: left;" href="{{ route('order.edit',$order->id) }}">Modifica</a><!-- LANCIO IL CREATE -->
  <div style="float: right;">
    <a class="btn btn-info" href="{{ route('panelcontrol') }}">Back to the orders</a>
    &nbsp;
    <form action="{{ route('order.store') }}" style="display:inline;" method="POST">
      @csrf
      @method('POST')
      <input type="hidden" name="idorder" value="{{ $order->id }}">
      <input id="backtopanel"  class="btn btn-outline-dark" type="submit"  value="Close and back to panel">
    </form>

    &nbsp;

    <form action="{{ route('order.update',$order->id) }}" style="display:inline;" method="POST">
      @csrf
      @method('PUT')
      <input type="hidden" name="delivered" value="1">
      <input id="nextorder"  class="btn btn-primary" type="submit" value="Next order">
    </form>

  </div>
  @else
  <div style="float: right;">
    <a class="btn btn-info" href="{{ route('panelcontrol') }}">Back to the orders</a>&nbsp;
    <a class="btn btn-light" href="{{ route('order.edit',$order->id) }}">Modifica</a><!-- LANCIO IL CREATE -->
  </div>

  @endif

</div>




@stop

@section('css')

<!-- <link rel="stylesheet" href="/css/admin_custom.css"> -->
@stop

@section('js')
@include('construct.badgeorder')

<script type="text/javascript">
  $('#nextorder').click(function() {
    if (confirm('Close this order and continue cycling?')) {
      return true;
    }
    else{
      return false;
    }
  });
</script>

<script type="text/javascript">
  $('#backtopanel').click(function() {
    if (confirm('Close this order and return on panel?')) {
      return true;
    }
    else{
      return false;
    }
  });


</script>
@stop
