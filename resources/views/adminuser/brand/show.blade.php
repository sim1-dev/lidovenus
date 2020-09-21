@extends('adminlte::page')

@section('title', 'Order')

@section('content_header')
<h1 class="text-left my-4"><b>Marchio {{ $brand->id}} - {{ $brand->name}} - Creato il {{ $brand->created_at}}</b></h1>
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

<div class="container-fluid">
	<form action="{{ route('brand.update',$brand->id) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')
		<h3 class="text-left my-4 w-100"><b>Nome:</b></h3>
		<input type="text" class="form-control" name="name" value="{{ $brand->name}}"><br>
		<h3 class="text-left my-4 w-100"><b>Indirizzo:</b></h3>
		<input type="text" class="form-control" name="address" value="{{ $brand->address}}"><br>
		<h3 class="text-left my-4 w-100"><b>Descrizione:</b></h3>
		<textarea class="form-control" name="description">{{ $brand->description}}</textarea><br>
		<img src="{{ url('images_brand/',$brand->image)}}" width="100px" height="100px"><br>
		<h3 class="text-left my-4 w-100"><b>Immagine:</b></h3>
        <p><input type="file" name="image"></p>

		<input type="submit" class="btn btn-primary w-25 float-right" value="AGGIORNA MARCHIO">
	</form>
	<a type="button" style="float: right" href="{{ route('brand.index') }}" class="btn btn-danger w-25 float-right mx-2">TORNA INDIETRO</a>
</div>

<div class="container-fluid">


	@if (empty($brandproduct[0]))
  <div>
    Nessun prodotto associato a questo marchio
  </div>
  @else
  <h3 class="text-left my-4 w-100"><b>Prodotti con questo marchio:</b></h3>
	<table class="table table-bordered table-striped table-hover dataTable">
		<thead class="bg-dark">
			<tr role="row">
				<th id="colonna1">#</th>
				<th id="colonna1">Nome Prodotto</th>
				<th id="colonna2">Creato il</th>
				<th id="colonna2">Modificato il</th>
				<th id="colonna2">Quantità</th>
			</tr>
		</thead>
		<tbody>
			<ul>
				@foreach ($brandproduct as $element)
				<tr role="row">
					<td><a href="{{ route('product.show',$element->id) }}">{{ $element->id }}</a></td>
					<td>{{ $element->name }}</td>
					<td>{{ $element->created_at }}</td>
					<td>{{ $element->updated_at }}</td>
					<td>{{ $element->quantitystock }}</td>
				</tr>
				@endforeach

			</ul>
		</tbody>
	</table>
	<div class="d-flex justify-content-center">
    {{ $brandproduct->links() }}
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
