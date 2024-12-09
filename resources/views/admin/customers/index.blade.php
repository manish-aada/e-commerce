@extends('layouts.admin.app')

@section('title', 'Customers')

@section('content')
<div class="container mt-5">
	<h3>Customers List</h3>
	@if ($customers->isEmpty())
		<div class="alert alert-warning">
			No customers found.
		</div>
	@else
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>Name</th>
				<th>Email</th>
				<th>Contact</th>
				<th>Address</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($customers as $customer)
				<tr>
					<td>{{ $customer->name }}</td>
					<td>{{ $customer->email }}</td>
					<td>{{ $customer->contact }}</td>
					<td>{{ $customer->address }}</td>
					<td>
						<button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#customerModal"
								data-id="{{ $customer->id }}" data-name="{{ $customer->name }}"
								data-email="{{ $customer->email }}" data-contact="{{ $customer->contact }}"
								data-address="{{ $customer->address }}">View</button>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	@endif
</div>

<!-- Modal -->
<div class="modal fade" id="customerModal" tabindex="-1" aria-labelledby="customerModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="customerModalLabel">Customer Details</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<p><strong>Name:</strong> <span id="customerName"></span></p>
				<p><strong>Email:</strong> <span id="customerEmail"></span></p>
				<p><strong>Contact:</strong> <span id="customerContact"></span></p>
				<p><strong>Address:</strong> <span id="customerAddress"></span></p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

@section('scripts')
<script>
	// Event listener for when the modal is about to be shown
	$('#customerModal').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget); // Button that triggered the modal
		var name = button.data('name'); 
		var email = button.data('email');
		var contact = button.data('contact');
		var address = button.data('address');

		// Update the modal's content
		var modal = $(this);
		modal.find('#customerName').text(name);
		modal.find('#customerEmail').text(email);
		modal.find('#customerContact').text(contact);
		modal.find('#customerAddress').text(address);
	});
</script>
@endsection

@endsection
