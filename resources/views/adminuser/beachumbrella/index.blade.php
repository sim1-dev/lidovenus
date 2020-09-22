@extends('adminlte::page')

@section('title', 'Order')

@section('content_header')
<h2 class="my-4"><b>Ombrelloni</b></h2>
@stop

@section('content')
@include('layouts.alert')

<div class="row">
  <!-- 1 -->
  <div class="col-sm-4">

    <form id="registerumbrella" class="px-2 py-2" action="{{ route('beachumbrella.store') }}" method="POST">
      @csrf
      <div class="form-group"><br>
        <h4 class="text-left"><b>Crea Ombrellone</b></h4><br>
        <select class="form-control" name="type">
          <option value="Ombrellone piccolo (2 posti)">Ombrellone piccolo (2 posti)</option>
          <option value="Ombrellone grande (4 posti)">Ombrellone grande (4 posti)</option>
          <option value="Palma (5 posti)">Palma (5 posti)</option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary w-100">CREA OMBRELLONE</button>
    </form>

  </div>

<!-- 2 -->
  <div class="col-sm-4">
    <br>
   <form id="showumbrella" class="px-2 py-2" action="{{ route('beachumbrella.show','') }}" method="GET" onsubmit="$().showumbrella();">
      <div class="form-group">
        <h4 class="text-left"><b>Visualizza Ombrellone</b></h4><br>
        <input type="text" class="form-control" id="idumbrella" placeholder="Inserisci ID Ombrellone">
      </div>
      <button type="submit" class="btn btn-success w-100">VISUALIZZA OMBRELLONE</button>
    </form>
  </div>
  <!-- 3 -->
  <div class="col-sm-4">

  <br>
   <form id="deleteumbrella" class="px-2 py-2" action="{{ route('beachumbrella.destroy','') }}" method="POST">
      @method('DELETE')
      @csrf
      <div class="form-group">
        <h4 class="text-left"><b>Elimina Ombrellone</b></h4><br>

        <input type="text" class="form-control" min="1" id="idumbrelladelete" name="idumbrelladelete" placeholder="Inserisci ID Ombrellone">
      </div>
      <button id="buttonumbrelladelete" type="submit" class="btn btn-danger w-100">ELIMINA OMBRELLONE</button>
    </form>
  </div>
</div>
</div>
<br>

<div class="row">

</div>



<h4 class="my-4"><b>Lista Ombrelloni</b></h4>

<table class="table table-striped">
    <thead class="table-dark">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Tipo</th>
        <th scope="col">Data aggiunta</th>
        <!--<th scope="col">Azioni</th>-->
      </tr>
    </thead>
    <tbody>
    @foreach ($umbrellas as $umbrella)
    <tr>
        <th scope="row">{{ $umbrella->id }}</th>
        <td>{{ $umbrella->type }}</td>
        <td>{{ $umbrella->created_at }}</td>
           {{--
    <td>
          <form id="showumbrella" action="{{ route('beachumbrella.show','') }}" method="GET" onsubmit="$().showumbrella();">
            @csrf
            <input type="number" hidden class="form-control w-50 float-left"id="iduser" name="iduser" placeholder="{{ $umbrella->id }}">
            <button type="submit" class="btn btn-success">Visualizza</button>
            </form>
            <form id="deleteumbrella" action="{{ route('beachumbrella.destroy','') }}" method="POST">
            @method('DELETE')
            @csrf
            <input type="number" hidden class="form-control w-50 float-left" id="iduserdelete" name="iduserdelete" placeholder="{{ $umbrella->id }}">
            <button type="submit" class="btn btn-danger">Elimina</button>
            </form>
        </td>
    --}}
      </tr>
    @endforeach
    </tbody>
  </table>

  <div class="d-flex justify-content-center">
    {{ $umbrellas->links() }}
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

    if (id != 0 && id != '' && confirm('Sei sicuro di voler eliminare questo ombrellone?')) {
      $ciao = $("#deleteumbrella").attr("action",linkbasic2+"/"+id);
      return true;
    }
    else{
      return false;
    }
  });





  </script>

@stop
