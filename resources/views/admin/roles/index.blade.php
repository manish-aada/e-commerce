@extends('layouts.admin.app')

@section('title', 'Manage Roles')

@section('content')
<div class="container mt-4">
	<h2>Manage Roles</h2>

	@if(session('success'))
		<div class="alert alert-success">
			{{ session('success') }}
		</div>
	@endif

	<a href="{{ route('admin.roles.create') }}" class="btn btn-primary mb-3">Create New Role</a>
	@if ($roles->isEmpty())
		<div class="alert alert-warning">
			No roles found.
		</div>
	@else
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>Name</th>
				<th>Slug</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			@foreach($roles as $role)
				<tr>
					<td>{{ $role->name }}</td>
					<td>{{ $role->slug }}</td>
					<td>
						<a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-warning btn-sm">Edit</a>
						<form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" style="display:inline;">
							@csrf
							@method('DELETE')
							<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
						</form>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	@endif
</div>
@endsection
