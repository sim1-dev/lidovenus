@extends('adminlte::page')

@section('title', 'Order')

@section('content_header')
<h1><b>Marchio</b></h1>
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

     <form id="registeruser" class="px-2 py-2" enctype="multipart/form-data" action="{{ route('brand.store') }}" method="POST">
      @csrf
      <div class="form-group"><br>
        <h3><b>Crea Marchio</b></h3><br>
        <input type="text" class="form-control"  name="name" placeholder="Nome" >
      </div>

      <div class="form-group">
        <input type="text" class="form-control"  name="address" placeholder="Indirizzo" >
      </div>

      <div class="form-group">
        <input type="text" class="form-control" name="description" placeholder="Descrizione" >
        
      </div>

      <div class="form-group">
        <h3><b>Logo:</b></h3><br>
        <input type="file" name="image" />
      </div>

      
      <button type="submit" class="btn btn-primary w-100">CREA MARCHIO</button>
    </form> 
    
 </div>

 <!-- 2 -->
 <div class="col-sm-4">
  <br>
  <form id="showumbrella" class="px-2 py-2" action="{{ route('brand.show','') }}" method="GET" onsubmit="$().showumbrella();">
    <div class="form-group">
      <h3><b>Visualizza Marchio</b></h3><br>
      <input type="text" class="form-control" id="idumbrella" placeholder="Inserisci ID Marchio">
    </div>
    <button type="submit" class="btn btn-success w-100">VISUALIZZA MARCHIO</button>
  </form>
</div>
<!-- 3 -->
<div class="col-sm-4">

  <br>
  <form id="deleteumbrella" class="px-2 py-2" action="{{ route('brand.destroy','') }}" method="POST">
    @method('DELETE')
    @csrf
    <div class="form-group">
      <h3><b>Elimina Marchio</b></h3><br>

      <input type="text" class="form-control" min="1" id="idumbrelladelete" name="idumbrelladelete" placeholder="Inserisci ID Marchio">
    </div>
    <button id="buttonumbrelladelete" type="submit" class="btn btn-danger w-100">ELIMINA MARCHIO</button>
  </form>
</div>
</div>
</div> 
<br>

<div class="row">

</div>





<br>

<h4 class="my-4"><b>Lista Marchi</b></h4>

<table class="table table-striped">
    <thead class="table-dark">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nome</th>
        <th scope="col">Descrizione</th>
        <th scope="col">Data Aggiunta</th>
        <th scope="col">Indirizzo</th>
        <th scope="col">Immagine</th>
        <!--<th scope="col">Azioni</th>-->
      </tr>
    </thead>
    <tbody>
    @foreach ($brands as $brand)
      <tr>
        <th scope="row">{{ $brand->id }}</th>
        <td>{{ $brand->name }}</td>
        <td>{{ $brand->description }}</td>
        <td>{{ $brand->created_at }}</td>
        <td>{{ $brand->address }}</td>
        <td><img style="max-width:64px" src='{{ asset('images_brand/'.$brand->image) }}'></td>
      </tr>
    @endforeach
    </tbody>
  </table>

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

    if (id != 0 && id != '' && confirm('Sei sicuro di voler eliminare questo marchio?')) {
      $ciao = $("#deleteumbrella").attr("action",linkbasic2+"/"+id);
      return true;
    }
    else{
      return false;
    }
  });

  



</script>

@stop