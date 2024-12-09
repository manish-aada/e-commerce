@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="container mt-5">
	<div class="row justify-content-center">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header text-center">
					<h4>Login</h4>
				</div>
				<div class="card-body">
					
					<div id="messageDiv" class="mb-3" style="display: none;">
						<div id="successMessage" class="alert alert-success" style="display: none;"></div>
						<div id="errorMessage" class="alert alert-danger" style="display: none;"></div>
					</div>

					<form id="loginForm">
						@csrf
						<div class="mb-3">
							<label for="email" class="form-label">Email</label>
							<input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
							<div id="emailError" class="text-danger small"></div>
						</div>
						<div class="mb-3">
							<label for="password" class="form-label">Password</label>
							<input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
							<div id="passwordError" class="text-danger small"></div>
						</div>
						<button type="submit" class="btn btn-primary w-100">Login</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$('#loginForm').submit(function(e) {
		e.preventDefault();
		$('.text-danger').text(''); 
		$('#messageDiv').hide(); 

		$.ajax({
			url: '{{ route('login') }}',
			method: 'POST',
			data: $(this).serialize(),
			success: function(response) {
				$('#messageDiv').show(); 
				$('#successMessage').text(response.message).show(); 
				$('#errorMessage').hide(); 

				
				if (response.userRole === 'admin') {
					window.location.href = "{{ route('admin.dashboard') }}"; 
				} else {
					window.location.href = "{{ route('home') }}"; 
				}
			},
			error: function(xhr) {
				$('#messageDiv').show(); 
				if (xhr.status === 422) {
					
					let errors = xhr.responseJSON.errors;
					if (errors.email) {
						$('#emailError').text(errors.email[0]);
					}
					if (errors.password) {
						$('#passwordError').text(errors.password[0]);
					}
					$('#successMessage').hide(); 
					$('#errorMessage').hide(); 
				} else {
					// Invalid credentials error
					$('#errorMessage').text('Invalid credentials!').show();
					$('#successMessage').hide();
				}
			}
		});
	});
</script>

@endsection
