@extends('layouts.admin.app')

@section('title', 'Product List')

@section('content')
<div class="container mt-5">
	<h3>Product List</h3>
	<a href="{{ route('admin.products.add') }}" class="btn btn-primary mb-3">Add New Product</a>
	@if ($products->isEmpty())
		<div class="alert alert-warning">
			No products found.
		</div>
	@else
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>Name</th>
				<th>Price</th>
				<th>Quantity</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($products as $product)
				<tr>
					<td>{{ $product->name }}</td>
					<td>${{ number_format($product->price, 2) }}</td>
					<td>{{ $product->quantity }}</td>
					<td>
						<a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>
						<button 
							type="button" 
							class="btn btn-danger btn-sm delete-btn" 
							data-bs-toggle="modal" 
							data-bs-target="#deleteModal" 
							data-id="{{ $product->id }}">
							Delete
						</button>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	@endif
</div>


<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				Are you sure you want to delete this product?
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
				<form id="deleteForm" method="POST" style="display: inline;">
					@csrf
					@method('DELETE')
					<button type="submit" class="btn btn-danger">Yes, Delete</button>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
	document.addEventListener('DOMContentLoaded', function () {
		
		document.querySelectorAll('.delete-btn').forEach(button => {
			button.addEventListener('click', function () {
				const productId = this.getAttribute('data-id');
				const deleteForm = document.getElementById('deleteForm');
				const actionUrl = "{{ route('admin.products.delete', ':id') }}".replace(':id', productId);
				deleteForm.setAttribute('action', actionUrl);
			});
		});
	});
</script>
@endsection
