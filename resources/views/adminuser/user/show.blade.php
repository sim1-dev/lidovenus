@extends('adminlte::page')

@section('title', 'Order')

@section('content_header')
<h1 class="text-left"><b>Utente {{ $user->id }} - {{ $user->name }}  {{ $user->surname }} - Registrato il {{ $user->created_at}}</b></h1>
@stop

@section('content')
@include('layouts.alert')

<!-- <label>
  Search number order
  <form id="search" action="{{ route('order.show','') }}" onsubmit="$().showorder();">
    <input class="form-control form-control-sm" id="ordernumber" placeholder="Enter for search">
  </form>
</label> -->

@if ($errors->any())
<div class="alert alert-danger">
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif

<div class="container-fluid">
  <form action="{{ route('user.update',$user->id) }}" method="POST">
    @csrf
    @method('PUT')
    <h3 class="text-left w-100 my-4"><b>Nome:</b></h3>
    <input class="form-control" type="text" name="name" value="{{ $user->name }}" required>
    <h3 class="text-left w-100 my-4"><b>Cognome:</b></h3>
    <input class="form-control" type="text" name="surname" value="{{ $user->surname }}" required><br>
    <h3 class="text-left w-100 my-4"><b>Email:</b></h3>
    <input class="form-control" type="text" name="email"  value="{{ $user->email }}" required><br>
    <h3 class="text-left w-100 my-4"><b>Comune:</b></h3>
    <input class="form-control" type="text" name="municipality"  value="{{ $user->municipality }}"><br>
    <h3 class="text-left w-100 my-4"><b>CAP:</b></h3>
    <input class="form-control" type="text" name="cap" value="{{ $user->cap }}"><br>
    <h3 class="text-left w-100 my-4"><b>Indirizzo:</b></h3>
    <input class="form-control" type="text" name="address"  value="{{ $user->address }}"><br>





    <input type="submit" class="btn btn-primary w-100 my-4 py-2" value="AGGIORNA UTENTE">
  </form>
  <p></p>

  @if (!empty($orders[0]))
  <table id="tableorders" class="table table-bordered table-striped table-hover dataTable">
    <h3 class="text-left my-4"><b>Ordini di {{ $user->name }}  {{ $user->surname }}:</b></h3>
    <thead class="bg-dark">
      <tr role="row" style="width: 100%">
        <th id="colonna1">#</th>
        <th id="colonna2">ID Ombrellone</th>
        <th id="colonna2">Prodotti</th>
        <th id="colonna3">Quantità Totale Prodotti</th>
        <th id="colonna4">Totale in €</th>
        <th id="timestamp" class="header headerSortDown">Data Ordine</th>
        <th id="action">Azioni</th>
      </tr>
    </thead>
    <tbody>


      <ul>


        @foreach ($orders as $element)

        <tr role="row">
          <td><a href="{{ route('order.show',$element->id) }}">{{ $element->id }}</a></td>
          <td>
            @php
            $a = \App\Order::find($element->id);
            @endphp
            @foreach ($a->umbrellas as $umbrella)
            <a href="{{ route('beachumbrella.show',$umbrella->id) }}">{{ $umbrella->id }}</a>
            @endforeach
          </td>
          <td>
            @php
            $items = json_decode($element->id_products);

            $productNumber = 0;
            $totalOrder = 0;
            foreach ($items as $key=>$value) {
              $productNumber += $value->quantity;
              $totalOrder = $value->quantity * $value->price;
              echo $value->name." <b>x".$value->quantity."</b> ";
            }
            @endphp

          </td>

          <td>
            {{ $productNumber }}
          </td>
          <td style="background-color:#DDDDDD;">{{ $totalOrder }} €</td>
          <td>{{ $element->created_at }}</td>

          <td class="text-center"><a style="display:inline;float:left" href="{{ route('order.show',$element->id) }}"><img width="20px" height="20px" src="{{ asset('img/search.png') }}"></a>
            @if ($element->delivered)

            @else
            <form style="display:inline;float:right" action="{{ route('order.store') }}" method="POST">
              @csrf
              @method('POST')
              <input type="hidden" name="idorder" value="{{ $element->id }}">
              <input class="ordercompleted" type="image" src="{{ asset('img/tick.png') }}" width="20" height="20">
            </form>

            @endif
          </td>
        </tr>


        @endforeach
      </ul>
    </tbody>
  </table>



  <div class="d-flex justify-content-center">
    {{ $orders->links() }}
  </div>







  @else
  <h3 class="text-left w-100"><b>Nessun ordine</b></h3>
  @endif
  @if (!empty($subscriptions[0]))

  <table id="tableorders" class="table table-bordered table-striped table-hover dataTable">
    <h3 class="text-left w-100 my-4"><b>Abbonamenti di {{ $user->name }}  {{ $user->surname }}:</b></h3>
    <thead class="bg-dark">
      <tr role="row">
        <th id="colonna1">#</th>
        <th id="colonna2">ID Ombrellone</th>
        <th id="colonna2">Data Inizio</th>
        <th id="colonna3">Data Fine</th>
        <th id="action">Azioni</th>
      </tr>
    </thead>
    <tbody>
      <ul>
        @foreach ($subscriptions as $element)

        <tr role="row">
          <td>{{ $element->id }}</td>
          <td><a href="{{ route('beachumbrella.show',$element->idumbrella) }}">{{ $element->idumbrella }}</a></td>
          <td>{{ $element->from }}</td>
          <td>{{ $element->to }}</td>


          <td class="text-center">
            <a style="display:inline;float:left" href="">
              <img width="20px" height="20px" src="{{ asset('img/search.png') }}">
            </a>

          </td>
        </tr>


        @endforeach
      </ul>
    </tbody>

  <div class="d-flex justify-content-center">
    {{ $subscriptions->links() }}
  </div>
  @else
  <h3 class="text-left">Nessun abbonamento collegato</h3>
  @endif
</div>
@stop

@section('css')

<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')


@include('construct.badgeorder')

<script>
  var linkbasic = $("#search").attr("action");
  (function( $ ){
   $.fn.showorder = function() {
    var id = $("#ordernumber").val();
    $ciao = $("#search").attr("action",linkbasic+"/"+id);

  };
})( jQuery );

</script>

@stop
