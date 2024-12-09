@extends('layouts.app')

@section('title', isset($product) ? 'Edit Product' : 'Add Product')

@section('content')
<div class="container mt-5">
	<h3>{{ isset($product) ? 'Edit Product' : 'Add Product' }}</h3>
	<form action="{{ isset($product) ? route('admin.products.save', $product->id) : route('admin.products.save') }}" method="POST">
		@csrf
		@isset($product)
			@method('POST')
		@endisset

		<div class="mb-3">
			<label for="name" class="form-label">Product Name</label>
			<input type="text" class="form-control" id="name" name="name" value="{{ old('name', $product->name ?? '') }}" required>
		</div>
		<div class="mb-3">
			<label for="price" class="form-label">Price</label>
			<input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ old('price', $product->price ?? '') }}" required>
		</div>
		<div class="mb-3">
			<label for="quantity" class="form-label">Quantity</label>
			<input type="number" class="form-control" id="quantity" name="quantity" value="{{ old('quantity', $product->quantity ?? '') }}" required>
		</div>
		<div class="mb-3">
			<label for="description" class="form-label">Description</label>
			<textarea class="form-control" id="description" name="description">{{ old('description', $product->description ?? '') }}</textarea>
		</div>

		<button type="submit" class="btn btn-success">{{ isset($product) ? 'Update' : 'Add' }} Product</button>
	</form>
</div>
@endsection
