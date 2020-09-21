@extends('adminlte::page')

@section('title', 'Order')

@section('content_header')
<h1 class="text-left my-4"><b>Ombrellone {{ $bu->id }} - {{ $bu->type}} - Creato il {{ $bu->created_at}}</b></h1>
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

<div class="container">
  <form action="{{ route('beachumbrella.update',$bu->id) }}" method="POST">
    @csrf
    @method('PUT')
    <h3 class="text-left my-4"><b>Tipo Ombrellone:</b></h3>
      <select class="form-control" name="type">
        @php
        $typeofumbrella = ['Ombrellone piccolo (2 posti)','Ombrellone grande (4 posti)','Palma (5 posti)'];
        @endphp
        @foreach ($typeofumbrella as $element)
        @if ($element == $bu->type)
        <option selected value="{{ $element }}">{{ $element }}</option>
        @else
        <option value="{{ $element }}">{{ $element }}</option>
        @endif
        @endforeach
      </select>
    </p>

    <input type="submit" class="btn btn-primary float-right" value="AGGIORNA OMBRELLONE">
  </form>
  <a type="button" href="{{ route('beachumbrella.index') }}" class="btn btn-danger float-right mx-2">TORNA INDIETRO</a>
</div>
<br><br><br><br>

<div class="container">

  @if (empty($theordersumbrella[0]))
  <div style="text-align: center;">
    Nessun ordine per questo ombrellone
  </div>
  @else
  <table class="table table-bordered bg-striped table-hover dataTable">
    <thead class="bg-dark">
      <tr role="row">
        <th id="colonna1">ID Ordine</th>
        <th id="colonna2">Creato il</th>
        <th id="colonna2">Aggiornato il</th>
        <th id="colonna2">Consegnato</th>
      </tr>
    </thead>
    <tbody>
      <ul>
        @foreach ($theordersumbrella as $element)
        <tr role="row">
          <td><a href="{{ route('order.show',$element->id) }}">{{ $element->id }}</a></td>
          <td>{{ $element->created_at }}</td>
          <td>{{ $element->updated_at }}</td>
          <td>
            @if ($element->delivered == 1)
            Yes
            @else
            No
            @endif
          </td>
        </tr>
        @endforeach
      </ul>
    </tbody>
  </table>

  <div class="d-flex justify-content-center">
    {{ $theordersumbrella->links() }}
  </div>


  @endif





</div>

@stop

@section('css')

<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')


@include('construct.badgeorder')


@stop
