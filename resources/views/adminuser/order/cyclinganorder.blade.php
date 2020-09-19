@extends('adminlte::page')

@section('title', 'Order')

@section('content_header')
<h1 class="mb-5"><b>Ordine {{ $order->id}}</b></h1>
@stop

@section('content')


<div class="container" style="width: auto;">
  <h4><b>ID Ombrellone:</b> {{ $order->id }}</h4>
  <hr>

  @foreach ($order->umbrellas as $element)
  <h4><b>ID Ombrellone:</b> {{ $element->id }}</h4>
  @endforeach
  <hr>

  @foreach ($order->users as $element)
  <h4><b>ID Utente:</b> {{ $element->id }}</h4>
  @endforeach

  <hr>
  <h4><b>Status:</b>
    @if ($order->delivered)
    Consegnato
    @else
    Non consegnato
    @endif

  </h4>
  <hr>
  <h4><b>Data Ordine:</b> {{ $order->created_at}}</p>
  <table class="table" style="text-align: center;">


    <label><h3 class="mt-5">Prodotti:</h3></label>
    <thead>
      <tr role="row">
        <th>ID Prodotto:</th>
        <th>Nome Prodotto:</th>
        <th>Quantità:</th>
        <th>Prezzo:</th>
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
          {{ $c }}€

        </td>
      </tr>
      @endforeach

    </tbody>
  </table>
  <label>Totale: {{ $pricetotal }} €</label><br><br>

  @if (!$order->delivered)
  <a class="btn btn-warning" style="float: left;" href="{{ route('order.edit',$order->id) }}">Modifica Ordine</a>
  <div style="float: right;">
    <a class="btn btn-danger" href="{{ route('panelcontrol') }}">Torna al riepilogo ordini</a>
    &nbsp;
    <form action="{{ route('order.store') }}" style="display:inline;" method="POST">
      @csrf
      @method('POST')
      <input type="hidden" name="idorder" value="{{ $order->id }}">
      <input id="backtopanel"  class="btn btn-info" type="submit"  value="Chiudi ordine e torna al riepilogo">
    </form>

    &nbsp;

    <form action="{{ route('order.update',$order->id) }}" style="display:inline;" method="POST">
      @csrf
      @method('PUT')
      <input type="hidden" name="delivered" value="1">
      <input id="nextorder"  class="btn btn-success" type="submit" value="Chiudi ordine e passa al successivo">
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
