<!DOCTYPE html>
<html lang="en">
	<head>
	  <meta charset="UTF-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	  <title>@yield('title')</title>
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
		  <div class="container-fluid">
			 <a class="navbar-brand" href="{{ route('home') }}" 
				 class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
			 <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
				aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			 </button>
			 <div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav ms-auto">
				  @auth
				  <li class="nav-item">
					 <a class="nav-link {{ request()->routeIs('cart') ? 'active' : '' }}" href="{{ route('cart') }}">Cart</a>
				  </li>
				  <li class="nav-item">
					 <a class="nav-link {{ request()->routeIs('profile') ? 'active' : '' }}" href="{{ route('profile') }}">Profile</a>
				  </li>
				  <li class="nav-item">
					 <a class="nav-link" href="{{ route('logout') }}">Logout</a>
				  </li>
				  @else
				  <li class="nav-item">
					 <a class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}" href="{{ route('login') }}">Login</a>
				  </li>
				  <li class="nav-item">
					 <a class="nav-link {{ request()->routeIs('register') ? 'active' : '' }}" href="{{ route('register') }}">Register</a>
				  </li>
				  @endauth
				</ul>
			 </div>
		  </div>
		</nav>

	  <main class="container my-4">
		 @if(session('message'))
		 <div class="container">
			<div class="row justify-content-center">
				<div class="col-12 col-md-3">
				  <div class="alert alert-success alert-dismissible fade show" role="alert">
					 {{ session('message') }}
					 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				  </div>
				</div>
			</div>
		 </div>
		 @endif
		 @yield('content')
	  </main>
	  <script>
		 setTimeout(function() {
			 $('.alert').hide();
		 }, 3000);
	  </script>
	</body>
</html>