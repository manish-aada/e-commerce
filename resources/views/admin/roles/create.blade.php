@extends('layouts.admin')

@section('title', 'Create Role')

@section('content')
<div class="container mt-4">
	<h2>Create New Role</h2>

	<form action="{{ route('admin.roles.store') }}" method="POST">
		@csrf

		<div class="mb-3">
			<label for="name" class="form-label">Role Name</label>
			<input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
			@error('name')
				<div class="text-danger small">{{ $message }}</div>
			@enderror
		</div>

		<div class="mb-3">
			<label for="slug" class="form-label">Slug</label>
			<input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug') }}" required>
			@error('slug')
				<div class="text-danger small">{{ $message }}</div>
			@enderror
		</div>

		<button type="submit" class="btn btn-primary">Create Role</button>
		<a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">Cancel</a>
	</form>
</div>
@endsection
