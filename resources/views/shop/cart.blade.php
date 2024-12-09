@extends('layouts.app')
@section('title', 'Shopping Cart')
@section('content')
<div class="container mt-5">
	<h1 class="mb-4">Shopping Cart</h1>
	@if ($cartItems->isEmpty())
	<div class="alert alert-info" role="alert">
		Your cart is empty. <a href="{{ route('home') }}" class="alert-link">Continue shopping</a>.
	</div>
	@else
	<table class="table table-bordered">
		<thead>
			<tr>
				<th scope="col">Product</th>
				<th scope="col">Name</th>
				<th scope="col">Price</th>
				<th scope="col">Quantity</th>
				<th scope="col">Total</th>
				<th scope="col">Actions</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($cartItems as $item)
			<tr>
				<td><img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" width="50"></td>
				<td>{{ $item->product->name }}</td>
				<td>${{ number_format($item->product->price, 2) }}</td>
				<td>
					<form method="POST" action="{{ route('cart.update', $item->id) }}" class="d-inline">
						@csrf
						@method('PUT')
						<input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="form-control form-control-sm" style="width: 70px;">
						<button type="submit" class="btn btn-primary btn-sm mt-2">Update</button>
					</form>
				</td>
				<td>${{ number_format($item->product->price * $item->quantity, 2) }}</td>
				<td>
					
					<button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal" 
						data-item-id="{{ $item->id }}" 
						data-item-name="{{ $item->product->name }}">
					Remove
					</button>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	<div class="d-flex justify-content-between align-items-center mt-4">
		<h4>Total: ${{ number_format($total, 2) }}</h4>
		<a href="{{ route('checkout') }}" class="btn btn-success">Proceed to Checkout</a>
	</div>
	@endif
</div>
<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="deleteModalLabel">Confirm Removal</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				Are you sure you want to remove <span id="itemName"></span> from your cart?
			</div>
			<div class="modal-footer">
				<form method="POST" id="deleteForm" action="" class="d-inline">
					@csrf
					@method('DELETE')
					<button type="submit" class="btn btn-danger">Remove</button>
				</form>
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
			</div>
		</div>
	</div>
</div>

<script>
	document.addEventListener('DOMContentLoaded', function () {
		 var deleteModal = document.getElementById('deleteModal');
		 deleteModal.addEventListener('show.bs.modal', function (event) {
			  var button = event.relatedTarget; 
			  var itemId = button.getAttribute('data-item-id'); 
			  var itemName = button.getAttribute('data-item-name'); 
	
		
			  var form = document.getElementById('deleteForm');
			  form.action = "{{ url('cart') }}/" + itemId;
	
			  
			  var itemNameElement = document.getElementById('itemName');
			  itemNameElement.textContent = itemName;
		 });
	});
</script>
@endsection