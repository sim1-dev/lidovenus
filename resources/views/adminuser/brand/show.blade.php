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
	<form action="{{ route('brand.update',$brand->id) }}" method="POST">
		@csrf
		@method('PUT')
		<p> <b>Brand id:</b><br>{{ $brand->id}}</p>
		<label>Name:</label><br>
		<input type="text" name="name" value="{{ $brand->name}}"><br>
		<label>Address:</label><br>
		<input type="text" name="address" value="{{ $brand->address}}"><br>
		<label>Description:</label><br>
		<textarea name="description">{{ $brand->description}}</textarea><br>
		<img src="{{ url('images_brand/',$brand->image) }} " width="100px" height="100px"><br>
		<label>Change Image:</label><br>
		<p><input type="file" name="image"></p>
		<p> Brand created_at: {{ $brand->created_at}}</p>
		<p> Brand updated_at: {{ $brand->updated_at}}</p>

		<input type="submit" class="btn btn-info" style="float: right;" value="Update">
	</form>
	<a type="button" style="float: right" href="{{ route('brand.index') }}" class="btn btn-link">Back to crud</a>
</div>
<br><br><br><br>

<div class="container" style="background-color: #fff;width: auto;text-align: center;">
	

	@if (empty($brandproduct[0]))
  <div style="text-align: center;">
    No product with this brand
  </div>
  @else
  <label>Product with this brand:</label><br>
	<table class="table table-bordered table-hover dataTable">
		<thead>
			<tr role="row" style="width: 100%">
				<th id="colonna1">Product id</th>
				<th id="colonna1">Product name</th>
				<th id="colonna2">Created at</th>
				<th id="colonna2">Updated at</th>
				<th id="colonna2">Quantity</th>
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