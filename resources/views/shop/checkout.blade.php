@extends('layouts.app')
@section('title', 'Checkout')
@section('content')
<div class="container mt-5">
	<h1>Checkout</h1>
	<form action="{{ route('checkout') }}" method="POST">
		@csrf
		<h4 class="mt-4">Billing Details</h4>
		<div class="mb-3">
			<label for="name" class="form-label">Full Name</label>
			<input type="text" class="form-control" id="name" name="name" value="{{ auth()->user()->name }}" required>
		</div>
		<div class="mb-3">
			<label for="address" class="form-label">Address</label>
			<textarea class="form-control" id="address" name="address" rows="3" required>{{ auth()->user()->address }}</textarea>
		</div>
		<div class="mb-3">
			<label for="contact" class="form-label">Phone Number</label>
			<input type="text" class="form-control" id="contact" name="contact" value="{{ auth()->user()->contact }}" required>
		</div>
		<h4 class="mt-4">Order Summary</h4>
		<ul class="list-group">
			@foreach ($cartItems as $item)
			<li class="list-group-item d-flex justify-content-between align-items-center">
				{{ $item->product->name }} (x{{ $item->quantity }})
				<span>${{ number_format($item->product->price * $item->quantity, 2) }}</span>
			</li>
			@endforeach
			<li class="list-group-item d-flex justify-content-between align-items-center">
				<strong>Total</strong>
				<strong>${{ number_format($total, 2) }}</strong>
			</li>
		</ul>
		<h4 class="mt-4">Payment Method</h4>
		<div class="form-check">
			<input class="form-check-input" type="radio" name="payment_method" id="cod" value="cod" checked>
			<label class="form-check-label" for="cod">Cash on Delivery</label>
		</div>
		<button type="submit" class="btn btn-success mt-4">Place Order</button>
	</form>
</div>
@endsection