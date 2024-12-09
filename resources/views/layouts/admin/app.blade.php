<!DOCTYPE html>
<html lang="en">
   <head>
	  <meta charset="UTF-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	  <title>@yield('title') - Admin Panel</title>
	  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
	  <style>
		 .nav-link.active {
		 font-weight: bold;
		 color: #007bff; 
		 text-decoration: none;
		 }
	  </style>
   </head>
   <body>
	  <nav class="navbar navbar-expand-lg navbar-light bg-light">
		 <a class="navbar-brand" href="#">Admin Panel</a>
		 <div class="collapse navbar-collapse">
			<ul class="navbar-nav ms-auto">
			   <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
			   <li class="nav-item"><a class="nav-link" href="{{ route('admin.roles.index') }}">Roles</a></li>
			   <li class="nav-item">
				  <a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">Dashboard</a>
			   </li>
			   <li class="nav-item">
				  <a class="nav-link {{ request()->is('admin/customers') ? 'active' : '' }}" href="{{ route('admin.customers') }}">Customers</a>
			   </li>
			   <li class="nav-item">
				  <a class="nav-link {{ request()->is('admin/vendors') ? 'active' : '' }}" href="{{ route('admin.vendors') }}">Vendors</a>
			   </li>
			   <li class="nav-item">
				  <a class="nav-link {{ request()->is('admin/products') ? 'active' : '' }}" href="{{ route('admin.products') }}">Products</a>
			   </li>
			   
			   <li class="nav-item">
				  <a class="nav-link {{ request()->is('admin/orders') ? 'active' : '' }}" href="{{ route('admin.orders') }}">Orders</a>
			   </li>
			   <li class="nav-item">
				  <a class="nav-link" href="{{ route('logout') }}">Logout</a>
			   </li>
			</ul>
		 </div>
	  </nav>
	  <div class="container mt-4">
		 @yield('content')
	  </div>
	  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
	  <script>
		 setTimeout(function() {
			 $('.alert').hide();
		 }, 3000);
	  </script>
   </body>
</html>