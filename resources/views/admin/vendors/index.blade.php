@extends('layouts.admin.app')

@section('title', 'Vendors')

@section('content')
<div class="container mt-5">
	<h3>Vendors List</h3>

	
	@if ($vendors->isEmpty())
		<div class="alert alert-warning">
			No vendors found.
		</div>
	@else
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Name</th>
					<th>Email</th>
					<th>Contact</th>
					<th>Address</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($vendors as $vendor)
					<tr>
						<td>{{ $vendor->name }}</td>
						<td>{{ $vendor->email }}</td>
						<td>{{ $vendor->contact }}</td>
						<td>{{ $vendor->address }}</td>
						<td>
							<button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#vendorModal" data-id="{{ $vendor->id }}" data-name="{{ $vendor->name }}" data-email="{{ $vendor->email }}" data-contact="{{ $vendor->contact }}" data-address="{{ $vendor->address }}">View</button>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	@endif
</div>


<div class="modal fade" id="vendorModal" tabindex="-1" aria-labelledby="vendorModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="vendorModalLabel">Vendor Details</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<p><strong>Name:</strong> <span id="vendorName"></span></p>
				<p><strong>Email:</strong> <span id="vendorEmail"></span></p>
				<p><strong>Contact:</strong> <span id="vendorContact"></span></p>
				<p><strong>Address:</strong> <span id="vendorAddress"></span></p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

@section('scripts')
	<script>
		
		$('#vendorModal').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget);
			var name = button.data('name'); 
			var email = button.data('email');
			var contact = button.data('contact');
			var address = button.data('address');
			
			
			var modal = $(this);
			modal.find('#vendorName').text(name);
			modal.find('#vendorEmail').text(email);
			modal.find('#vendorContact').text(contact);
			modal.find('#vendorAddress').text(address);
		});
	</script>
@endsection

@endsection
