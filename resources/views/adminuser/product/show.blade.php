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
	<form action="{{ route('product.update',$product->id) }}" method="POST">
		@csrf
		@method('PUT')
		<label>Product id:</label>
		<div class="form-group">
			{{ $product->id}}
		</div>

		<label>Name:</label>
		<div class="form-group">
			<input type="text" name="name" value="{{ $product->name}}">
		</div>

		<label>Description:</label>
		<div class="form-group">
			<textarea name="description">{{ $product->description}}</textarea>
		</div>

		<label>Change Image:</label>
		<div class="form-group">
			
			<img src="{{ url('images_products/',$product->img) }} " width="100px" height="100px">
			<input type="file" name="image">
		</div>
		
		<label>Price:</label>
		<div class="form-group">
			<input type="number" step="0.01" name="price" value="{{ $product->price}}">
		</div>

		<label>Brand:</label>
		<div class="form-group">
			Default brand: <a href="{{ route('brand.show',$product->brand) }}">{{ $product->brand }}</a><br>
			<select name="brand">
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
			Category:<br>
			<select name="category">
				@php
				$category = ['Drinks','Ice creams','Pizzas','Desk'];
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
		
		<label>Timestamp:</label>
		<div class="form-group">
			<b>created_at:</b>&nbsp;&nbsp;{{ $product->created_at}}<br>
			<b>updated_at:</b>&nbsp;&nbsp;{{ $product->updated_at}}
		</div>

		

		<input type="submit" class="btn btn-info" style="float: right;" value="Update">
	</form>
	<a type="button" style="float: right" href="{{ route('product.index') }}" class="btn btn-link">Back to crud</a>
</div>
<br><br><br><br>

<div class="container" style="background-color: #fff;width: auto;text-align: center;">
	

	




</div>

@stop

@section('css')

<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')


@include('construct.badgeorder')


@stop