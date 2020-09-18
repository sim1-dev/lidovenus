@extends('adminlte::page')

@section('title', 'Order')

@section('content_header')
<h1>Show / Update</h1>
@stop

@section('content')
@include('layouts.alert')

<label>
  Search number order
  <form id="search" action="{{ route('order.show','') }}" onsubmit="$().showorder();">
    <input class="form-control form-control-sm" id="ordernumber" placeholder="Enter for search">
  </form>
</label>

@if ($errors->any())
<div class="alert alert-danger">
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif

<div class="container" style="background-color: #fff;width: auto;text-align: center;">
  <p> User id: {{ $user->id }}</p>
  <hr>
  <p> Registered by: {{ $user->created_at}}</p>


  <form action="{{ route('user.update',$user->id) }}" method="POST">
    @csrf
    @method('PUT')
    <label>Name:</label><br>
    <input type="text" name="name" style="width: 66%" value="{{ $user->name }}"><br>
    <label>Surname:</label><br>
    <input type="text" name="surname" style="width: 66%" value="{{ $user->surname }}"><br>
    <label>Email:</label><br>
    <input type="text" name="email" style="width: 66%" value="{{ $user->email }}"><br>
    <label>Municipality:</label><br>
    <input type="text" name="municipality" style="width: 66%" value="{{ $user->municipality }}"><br>
    <label>Cap:</label><br>
    <input type="text" name="cap" style="width: 66%" value="{{ $user->cap }}"><br>
    <label>Address:</label><br>
    <input type="text" name="address" style="width: 66%" value="{{ $user->address }}"><br>


    {{--
      @if ($user->idumbrella)
    <label>Current umbrella: {{ $user->idumbrella }}&nbsp;&nbsp;</label>
      <select class="form-control" name="umbrella">
      <option value="{{ $user->idumbrella }}">{{ $user->idumbrella }}</option>
      @foreach ($umbrellass as $element)
      <option value="{{ $element->id }}">{{ $element->id }}</option>
      @endforeach
    </select>
     @else
    <label>No umbrella Assigned</label>
    <select class="form-control" name="umbrella">
      <option value="">Select umbrella</option>
      @foreach ($umbrellass as $element)
      <option value="{{ $element->id }}">{{ $element->id }}</option>
      @endforeach
    </select>
    @endif

    --}}






    <input type="submit" style="float: right;" class="btn btn-info" value="Aggiorna">
  </form>
  <p></p>

  @if (!empty($orders[0]))
  <table id="tableorders" class="table table-bordered table-hover dataTable" style="text-align: center;background-color: #fff">
    <h3 style="float: left;">Orders of user {{ $user->id }} :</h3>
    <thead>
      <tr role="row" style="width: 100%">
        <th id="colonna1" style="width:5%;">Order id</th>
        <th id="colonna2" style="width:10%;">Umbrella</th>
        <th id="colonna2" style="width:45%;">Products</th>
        <th id="colonna3" style="width:10%;">Total number of product</th>
        <th id="colonna4" style="width:5%;">Total € Order</th>
        <th id="timestamp" style="width: 10%;" class="header headerSortDown">Time stamp</th>
        <th id="action" style="width:5%;">Action</th>
      </tr>
    </thead>
    <tbody>


      <ul>


        @foreach ($orders as $element){{-- Avere l'id users && Id ombrellone --}}

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
              echo $value->name."(".$value->quantity.")";
            }
            @endphp

          </td>

          <td>
            {{ $productNumber }}
          </td>
          <td style="border: 1px solid #819AD4; text-align: center;">{{ $totalOrder }} €</td>
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
  <h3 style="float: left">No Order</h3>
  @endif
  @if (!empty($subscriptions[0]))

  <table id="tableorders" class="table table-bordered table-hover dataTable" style="text-align: center;background-color: #fff">
    <h3 style="float: left;">Subscription of this user:</h3>
    <thead>
      <tr role="row" style="width: 100%">
        <th id="colonna1" style="width:10%;">id</th>
        <th id="colonna2" style="width:10%;">Umbrella</th>
        <th id="colonna2" style="width:30%;">From</th>
        <th id="colonna3" style="width:30%;">To</th>
        <th id="action" style="width:10%;">Action</th>
      </tr>
    </thead>
    <tbody>
      <ul>
        @foreach ($subscriptions as $element){{-- Avere l'id users && Id ombrellone --}}

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
  <h3 style="float: left">No Order</h3>
  @endif
</div>
@stop

@section('css')

<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')


@include('construct.badgeorder')

<script>
  //Show
  var linkbasic = $("#search").attr("action");
  //console.log(linkbasic);
  (function( $ ){
   $.fn.showorder = function() {
    var id = $("#ordernumber").val();
    $ciao = $("#search").attr("action",linkbasic+"/"+id);

  };
})( jQuery );

</script>

@stop
