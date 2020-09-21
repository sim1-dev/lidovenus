@extends('adminlte::page')

@section('title', 'Order')

@section('content_header')
<h1 class="text-left"><b>Modifica ordine</b></h1>
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
