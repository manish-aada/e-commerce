<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
	
	protected $middleware = [
		\App\Http\Middleware\TrustProxies::class,
		\Illuminate\Http\Middleware\HandleCors::class,
		\Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
		\Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
		\Illuminate\Session\Middleware\StartSession::class,
		\Illuminate\View\Middleware\ShareErrorsFromSession::class,
		\Illuminate\Auth\Middleware\Authenticate::class,
		\App\Http\Middleware\PreventRequestsDuringMaintenance::class,
		\Illuminate\Routing\Middleware\SubstituteBindings::class,
		
	];

	
	protected $routeMiddleware = [
		'auth' => \App\Http\Middleware\Authenticate::class,
		'role' => \Spatie\Permission\Middleware\RoleMiddleware::class, 
		'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class, 
		'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
	];
}
