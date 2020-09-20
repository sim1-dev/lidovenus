@extends('adminlte::page')

@section('title', 'Order')

@section('content_header')
<h1>Show / Update</h1>
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

<div class="container" style="background-color: #fff;width: auto;text-align: center;">
  <form action="{{ route('beachumbrella.update',$bu->id) }}" method="POST">
    @csrf
    @method('PUT')
    <p> Umbrella id: {{ $bu->id}}</p>
    <p>This is a <b>{{ $bu->type}}</b> default <br>
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
    <p> Umbrella created_at: {{ $bu->created_at}}</p>
    <p> Umbrella updated_at: {{ $bu->updated_at}}</p>

    <input type="submit" class="btn btn-info" style="float: right;" value="Update">
  </form>
  <a type="button" style="float: right" href="{{ route('beachumbrella.index') }}" class="btn btn-link">Back to crud</a>
</div>
<br><br><br><br>

<div class="container" style="background-color: #fff;width: auto;text-align: center;">

  @if (empty($theordersumbrella[0]))
  <div style="text-align: center;">
    No order umbrella
  </div>
  @else
  <table class="table table-bordered table-hover dataTable">
    <thead>
      <tr role="row" style="width: 100%">
        <th id="colonna1">Order id</th>
        <th id="colonna2">Created at</th>
        <th id="colonna2">Updated at</th>
        <th id="colonna2">Delivered</th>
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
