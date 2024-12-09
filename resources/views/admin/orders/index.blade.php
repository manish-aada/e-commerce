@extends('layouts.admin.app')

@section('title', 'Orders')

@section('content')
<div class="container mt-5">
	<h3>Orders List</h3>
	@if ($orders->isEmpty())
		<div class="alert alert-warning">
			No orders found.
		</div>
	@else
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>Order ID</th>
				<th>Customer</th>
				<th>Total</th>
				<th>Status</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($orders as $order)
				<tr>
					<td>{{ $order->id }}</td>
					<td>{{ $order->name }}</td>
					<td>${{ number_format($order->total, 2) }}</td>
					<td>{{ $order->status }}</td>
					<td>
						
						<button class="btn btn-info btn-sm" 
								data-bs-toggle="modal" 
								data-bs-target="#orderModal" 
								data-order="{{ $order->toJson() }}">
							View
						</button>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	@endif
</div>


<div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="orderModalLabel">Order Details</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<h5>Customer: <span id="modalCustomerName"></span></h5>
				<p><strong>Address:</strong> <span id="modalCustomerAddress"></span></p>
				<p><strong>Phone:</strong> <span id="modalCustomerPhone"></span></p>
				<p><strong>Total:</strong> $<span id="modalTotal"></span></p>
				<p><strong>Status:</strong> <span id="modalStatus"></span></p>
				<hr>
				<h5>Order Items:</h5>
				<ul id="modalItemsList"></ul>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>


<script>
    var customerModal = document.getElementById('customerModal');
    customerModal.addEventListener('show.bs.modal', function (event) {
        // Get the button that triggered the modal
        var button = event.relatedTarget;

        // Get the customer details from the button's data attributes
        var customer = {
            name: button.getAttribute('data-name'),
            email: button.getAttribute('data-email'),
            contact: button.getAttribute('data-contact'),
            address: button.getAttribute('data-address')
        };

        // Update modal content with customer details
        document.getElementById('customerName').textContent = customer.name;
        document.getElementById('customerEmail').textContent = customer.email;
        document.getElementById('customerContact').textContent = customer.contact;
        document.getElementById('customerAddress').textContent = customer.address;
    });
</script>

@endsection
