@extends('layouts.admin.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container mt-5">
	<h3>Admin Dashboard</h3>
	<div class="row">
		<div class="col-md-3">
			<div class="card text-center">
				<div class="card-body">
					<h5 class="card-title">Customers</h5>
					<p class="card-text">{{ $customersCount }}</p>
					<a href="{{ route('admin.customers') }}" class="btn btn-primary">View Customers</a>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="card text-center">
				<div class="card-body">
					<h5 class="card-title">Vendors</h5>
					<p class="card-text">{{ $vendorsCount }}</p>
					<a href="{{ route('admin.vendors') }}" class="btn btn-primary">View Vendors</a>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="card text-center">
				<div class="card-body">
					<h5 class="card-title">Products</h5>
					<p class="card-text">{{ $productsCount }}</p>
					<a href="{{ route('admin.products') }}" class="btn btn-primary">View Products</a>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="card text-center">
				<div class="card-body">
					<h5 class="card-title">Orders</h5>
					<p class="card-text">{{ $ordersCount }}</p>
					<a href="{{ route('admin.orders') }}" class="btn btn-primary">View Orders</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
