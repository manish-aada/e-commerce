@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<div class="container mt-5">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header text-center">
					<h4>Update Profile</h4>
				</div>
				<div class="card-body">
					@if (session('success'))
						<div class="alert alert-success">
							{{ session('success') }}
						</div>
					@endif

					<form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
						@csrf
						<div class="mb-3">
							<label for="name" class="form-label">Name</label>
							<input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required>
							@error('name')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>

						<div class="mb-3">
							<label for="address" class="form-label">Address</label>
							<input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address', $user->address) }}">
							@error('address')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>

						<div class="mb-3">
							<label for="contact" class="form-label">Contact</label>
							<input type="text" class="form-control @error('contact') is-invalid @enderror" id="contact" name="contact" value="{{ old('contact', $user->contact) }}">
							@error('contact')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>

						<div class="mb-3">
							<label for="email" class="form-label">Email</label>
							<input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
							@error('email')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>

						<div class="mb-3">
							<label for="profile_picture" class="form-label">Profile Picture</label>
							@if ($user->profile_picture)
								<img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture" class="d-block mb-2" width="100">
							@endif
							<input type="file" class="form-control @error('profile_picture') is-invalid @enderror" id="profile_picture" name="profile_picture">
							@error('profile_picture')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>

						<div class="mb-3">
							<label for="password" class="form-label">Password (leave blank if not changing)</label>
							<input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
							@error('password')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>

						<div class="mb-3">
							<label for="password_confirmation" class="form-label">Confirm Password</label>
							<input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
						</div>

						<button type="submit" class="btn btn-primary w-100">Update Profile</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	document.getElementById('profile_picture').addEventListener('change', function () {
		const file = this.files[0];
		if (file.size > 2 * 1024 * 1024) { // 2 MB limit
			alert('File size exceeds 2MB. Please upload a smaller file.');
			this.value = '';
		}
	});
</script>

@endsection
