@extends('adminlte::page')

@section('title', 'Order')

@section('content_header')
<h1 class="text-left w-100 my-4"><b>Prodotto {{ $product->id }} - {{ $product->name}} - {{ $product->brand }} - {{ $product->price}}€ / cad. - Aggiunto il {{ $product->created_at}}</b></h1>
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
	<form action="{{ route('product.update',$product->id) }}" method="POST" enctype="multipart/form-data">
		@csrf
        @method('PUT')

		<h3 class="text-left w-100 my-4"><b>Nome:</b></h3>
		<input type="text" class="form-control" name="name" value="{{ $product->name}}">

		<h3 class="text-left w-100 my-4"><b>Descrizione:</b></h3>
			<textarea class="form-control" name="description">{{ $product->description}}</textarea>

            <h3 class="text-left w-100 my-4"><b>Immagine:</b></h3>
			<img src="{{ url('images_products/'.$product->img) }}" width="100px" height="100px">
			<input type="file" name="img">

		<h3 class="text-left w-100 my-4"><b>Prezzo:</b></h3>
			<input type="number" class="form-control" step="0.01" name="price" value="{{ $product->price}}">

        <h3 class="text-left w-100 my-4"><b>Quantità in magazzino:</b></h3>
			<input type="number" class="form-control" step="0.01" name="quantitystock" value="{{ $product->quantitystock}}">


		<h3 class="text-left w-100 my-4"><b>Marchio:</b></h3>
		<div class="form-group">
			<select class="form-control" name="brand">
				@foreach ($brand as $element)
				@if ($element->id == $product->brand)
				<option selected value="{{ $element->id }}">{{ $element->name }}</option>
				@else
				<option value="{{ $element->id }}">{{ $element->name }}</option>
				@endif
				@endforeach

			</select>
		</div>

		<div class="form-group">
			<h3 class="text-left w-100 my-4"><b>Categoria:</b></h3>
			<select class="form-control" name="category">
				@php
				$category = ['Bevande','Gelati','Pizze','Panini'];
				@endphp
				@foreach ($category as $element)
				@if ($element == $product->category)
				<option selected value="{{ $element }}">{{ $element }}</option>
				@else
				<option value="{{ $element }}">{{ $element }}</option>
				@endif

				@endforeach
			</select>
		</div>



        <input type="submit" class="btn btn-primary w-25 float-right" value="AGGIORNA">
        <a href="{{ route('product.index') }}" class="btn btn-danger w-25">TORNA INDIETRO</a>
    </form>

</div>

@stop

@section('css')

<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')


@include('construct.badgeorder')


@stop
