@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="container mt-5">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header text-center">
					<h4>Register</h4>
				</div>
				<div class="card-body">
					<div id="loader" class="text-center d-none mb-3">
						<i class="fa fa-spinner fa-spin" style="font-size:24px"></i> Processing...
					</div>
					<div id="success-message" class="alert alert-success d-none"></div>
					<div id="error-message" class="alert alert-danger d-none"></div>

					<form id="registerForm">
						@csrf
						<div class="mb-3">
							<label for="name" class="form-label">Name</label>
							<input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
							<div id="nameError" class="text-danger small"></div>
						</div>
						<div class="mb-3">
							<label for="address" class="form-label">Address</label>
							<input type="text" class="form-control" id="address" name="address" placeholder="Enter your address" required>
							<div id="addressError" class="text-danger small"></div>
						</div>
						<div class="mb-3">
							<label for="contact" class="form-label">Contact</label>
							<input type="text" class="form-control" id="contact" name="contact" placeholder="Enter your contact number" required>
							<div id="contactError" class="text-danger small"></div>
						</div>
						<div class="mb-3">
							<label for="email" class="form-label">Email</label>
							<input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
							<div id="emailError" class="text-danger small"></div>
						</div>
						<div class="mb-3">
							<label for="username" class="form-label">Username</label>
							<input type="text" class="form-control" id="username" name="username" placeholder="Choose a username" required>
							<div id="usernameError" class="text-danger small"></div>
						</div>
						<div class="mb-3">
							<label for="password" class="form-label">Password</label>
							<input type="password" class="form-control" id="password" name="password" placeholder="Enter a password" required>
							<div id="passwordError" class="text-danger small"></div>
						</div>
						<div class="mb-3">
							<label for="role" class="form-label">Role</label>
							<select class="form-select" id="role" name="role" required>
								<option value="customer">Customer</option>
								<option value="vendor">Vendor</option>
							</select>
							<div id="roleError" class="text-danger small"></div>
						</div>
						<div class="mb-3">
							<label for="profile_picture" class="form-label">Profile Picture</label>
							<input type="file" class="form-control" id="profile_picture" name="profile_picture">
							<div id="profilePictureError" class="text-danger small"></div>
						</div>
						<div class="mb-3">
							<label for="dob" class="form-label">Date of Birth</label>
							<input type="date" class="form-control" id="dob" name="dob">
							<div id="dobError" class="text-danger small"></div>
						</div>
						<button type="submit" class="btn btn-primary w-100">Register</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function () {
		$('#registerForm').submit(function (e) {
			e.preventDefault();

			$('.text-danger').text('');
			$('#success-message').addClass('d-none').text('');
			$('#error-message').addClass('d-none').text('');

			let $submitButton = $(this).find('button[type="submit"]');
			$submitButton.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Processing...');

			let formData = new FormData(this);

			$.ajax({
				url: '{{ route('register') }}',
				method: 'POST',
				data: formData,
				contentType: false,
				processData: false,
				success: function (response) {
					// Reset button and handle success
					$submitButton.prop('disabled', false).text('Register');
					$('#success-message').removeClass('d-none');
					$('#success-message').css({'display': 'flex'});
					$('#success-message').html(response.message);
					$('#registerForm').trigger('reset');
					setTimeout(function () {
						window.location.href = "{{ route('login') }}";
					}, 3000);
				},
				error: function (xhr) {
					$submitButton.prop('disabled', false).text('Register');
					if (xhr.status === 422) {
						let errors = xhr.responseJSON.errors;
						for (let key in errors) {
							$('#' + key + 'Error').text(errors[key][0]);
						}
					} else {
						$('#error-message').removeClass('d-none').text('Registration failed! Please try again.');
					}
				},
			});
		});
	});
</script>

@endsection
