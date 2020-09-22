@extends('adminlte::page')

@section('title', 'Order')

@section('content_header')
<h1 class="text-left"><b>Prodotti</b></h1>
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
  <div class="col-md-12">

   <form id="registeruser" class="px-2 py-2" enctype="multipart/form-data" action="{{ route('product.store') }}" method="POST">
    @csrf
    <h3 class="text-left"><b>Crea prodotto</b></h3>
    <div class="form-group">
      <label>Nome Prodotto:</label><br>
      <input type="text" class="form-control"  name="name" placeholder="Inserisci nome prodotto" >
    </div>

    <div class="form-group">
      <b>Categoria:</b><br>
      <select class="form-control" name="category">
        @php
        $category = ['Bevande','Gelati','Pizze','Panini'];
        @endphp
        @foreach ($category as $element)
        <option value="{{ $element }}">{{ $element }}</option>
        @endforeach
      </select>
    </div>

    <label>Prezzo:</label>
    <div class="input-group mb-3">
      <input type="number" class="form-control" step="0.01" name="price" placeholder="Prezzo" aria-describedby="basic-addon2">
      <div class="input-group-append">
        <span class="input-group-text" id="basic-addon2">€</span>
      </div>
    </div>

    <label>Descrizione:</label>
    <div class="form-group">
      <textarea class="form-control" name="description" placeholder="Descrizione"></textarea>
    </div>

    <label>Quantità:</label>
    <div class="form-group">
      <input type="number"  class="form-control" min="0" value="0" name="quantitystock" placeholder="Quantità in magazzino" >
    </div>

    <div class="form-group">
      <b class="w-100">Immagine:</b><br>
          <input type="file" name="img"/>
    </div>

    <label>Marchio:</label>
    <div class="form-group">
      <select class="form-control" name="brand">
        @foreach ($brand as $element)
          <option value="{{ $element->id }}">{{ $element->name }}</option>
        @endforeach

      </select>
    </div>




    <button type="submit" class="btn btn-primary w-100">CREA PRODOTTO</button>
  </form>

</div>

<!-- 2 -->
<div class="col-md-6">
  <br>
  <form id="showumbrella" class="px-2 py-2" action="{{ route('product.show','') }}" method="GET" onsubmit="$().showumbrella();">
    <div class="form-group">
      <h3><b>Visualizza Prodotto</b></h3><br>
      <input type="text" class="form-control" id="idumbrella" placeholder="Inserisci ID Prodotto">
    </div>
    <button type="submit" class="btn btn-success w-100">VISUALIZZA PRODOTTO</button>
  </form>
</div>
<!-- 3 -->
<div class="col-md-6">

  <br>
  <form id="deleteumbrella" class="px-2 py-2" action="{{ route('product.destroy','') }}" method="POST">
    @method('DELETE')
    @csrf
    <div class="form-group">
      <h3><b>Elimina Prodotto</b></h3><br>

      <input type="text" class="form-control" min="1" id="idumbrelladelete" name="idumbrelladelete" placeholder="Inserisci ID Prodotto">
    </div>
    <button id="buttonumbrelladelete" type="submit" class="btn btn-danger w-100">ELIMINA PRODOTTO</button>
  </form>
</div>
</div>
</div>
<br>

<div class="row">

</div>


<br>

<h4 class="my-4"><b>Lista Prodotti</b></h4>

<table id="dataTable" class="table table-striped DataTable">
    <thead class="table-dark">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nome</th>
        <th scope="col">Categoria</th>
        <th scope="col">Prezzo</th>
        <th scope="col">Quantità</th>
        <th scope="col">Descrizione</th>
        <th scope="col">Immagine</th>
        <!--<th scope="col">Azioni</th>-->
      </tr>
    </thead>
    <tbody>
    @foreach ($products as $product)
      <tr>
        <th scope="row">{{ $product->id }}</th>
        <td>{{ $product->name }}</td>
        <td>{{ $product->category }}</td>
        <td>{{ $product->price }}</td>
        <td>{{ $product->quantitystock }}</td>
        <td>{{ $product->description }}</td>
        <td> <img src="{{ url('images_products/'.$product->img)}}" width="100px" height="100px"> </td>
      </tr>
    @endforeach
    </tbody>
  </table>

  <div class="d-flex justify-content-center">
    {{ $products->links() }}
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
  var linkbasic = $("#showumbrella").attr("action");
  (function( $ ){
   $.fn.showumbrella = function() {
    var id = $("#idumbrella").val();
    $ciao = $("#showumbrella").attr("action",linkbasic+"/"+id);

  };
})( jQuery );

</script>
<script>
  //$('#dataTable').DataTable();
  var linkbasic2 = $("#deleteumbrella").attr("action");
  $('#buttonumbrelladelete').click(function() {
    var id = $("#idumbrelladelete").val();

    if (id != 0 && id != '' && confirm('Sei sicuro di voler eliminare questo prodotto?')) {
      $ciao = $("#deleteumbrella").attr("action",linkbasic2+"/"+id);
      return true;
    }
    else{
      return false;
    }
  });





</script>

@stop
