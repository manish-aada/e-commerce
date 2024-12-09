@extends('layouts.app')
@section('title', 'Product Details')
@section('content')
<div class="container mt-5">
   <div class="row justify-content-center">
	  <div class="col-md-8">
		 <div class="card">
			<div class="card-body text-center">
			   <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" class="img-fluid mb-3" style="max-height: 300px;">
			   <h1 class="card-title">{{ $product->name }}</h1>
			   <p class="card-text">{{ $product->description }}</p>
			   <p class="card-text"><strong>Price:</strong> ${{ $product->price }}</p>
			   <form id="add-to-cart-form">
				  @csrf
				  <input type="hidden" name="product_id" value="{{ $product->id }}">
				  <div class="mb-3">
					 <label for="quantity" class="form-label">Quantity:</label>
					 <input type="number" class="form-control" name="quantity" id="quantity" min="1" value="1" required>
					 <div id="quantityError" class="text-danger small"></div>
				  </div>
				  <button type="submit" class="btn btn-primary w-100">Add to Cart</button>
			   </form>
			   <div id="success-message" class="alert alert-success mt-3 d-none"></div>
			   <div id="error-message" class="alert alert-danger mt-3 d-none"></div>
			</div>
		 </div>
	  </div>
   </div>
</div>
<script>
   $(document).ready(function () {
	   $('#add-to-cart-form').submit(function (e) {
		   e.preventDefault();
   
		   $('#success-message').addClass('d-none').text('');
		   $('#error-message').addClass('d-none').text('');
		   $('#quantityError').text('');
   
		   $.ajax({
			   url: '{{ route('cart.add') }}',
			   method: 'POST',
			   data: $(this).serialize(),
			   success: function (response) {
				   $('#success-message').removeClass('d-none').text(response.message);
			   },
			   error: function (xhr) {
				   if (xhr.status === 422) {
					   
					   let errors = xhr.responseJSON.errors;
					   if (errors.quantity) {
						   $('#quantityError').text(errors.quantity[0]);
					   }
				   } else {
					   $('#error-message').removeClass('d-none').text('Something went wrong! Please try again.');
				   }
			   }
		   });
	   });
   });
</script>
@endsection