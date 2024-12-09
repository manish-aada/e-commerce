@extends('layouts.app')

@section('title', 'Shop')

@section('content')
	<h1 class="text-center my-4">Shop Products</h1>

 
	<div class="container">
		@if($products->isEmpty())
			<div class="alert alert-warning text-center" role="alert">
				No products found!
			</div>
		@else
			<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
				@foreach($products as $product)
					<div class="col">
						<div class="card h-100">
							<img src="{{ asset('storage/'.$product->image) }}" class="card-img-top" alt="{{ $product->name }}">
							<div class="card-body">
								<h5 class="card-title">{{ $product->name }}</h5>
								<p class="card-text">{{ $product->description }}</p>
								<p class="card-text">Price: ${{ $product->price }}</p>
								<a href="{{ route('product.details', $product->id) }}" class="btn btn-primary">View Details</a>
								<button class="btn btn-success add-to-cart" data-id="{{ $product->id }}">Add to Cart</button>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		@endif
	</div>

	<script>
		$(document).on('click', '.add-to-cart', function() {
			let productId = $(this).data('id');
			$.ajax({
				url: '{{ route('cart.add') }}',
				method: 'POST',
				data: {
					product_id: productId,
					quantity: 1,
					_token: '{{ csrf_token() }}',
				},
				success: function(response) {
					alert(response.message);
				},
				error: function(xhr) {
					alert('Failed to add item to cart!');
				}
			});
		});
	</script>
@endsection
