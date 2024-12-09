<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
class User extends Authenticatable
{
	use HasFactory, Notifiable,HasRoles;
	protected $guard_name = 'web';
	
	protected $fillable = [
		'name',
		'address',
		'contact',
		'email',
		'username',
		'password',
		'profile_picture',
		'dob',
		'role',
	];

	
	protected $hidden = [
		'password',
		'remember_token',
	];

	
	protected function casts(): array
	{
		return [
			'email_verified_at' => 'datetime',
			'password' => 'hashed',
		];
	}

	protected $casts = [
		'dob' => 'date',
	];

	public function orders()
	{
		return $this->hasMany(Order::class);
	}

	public function cartItems()
	{
		return $this->hasMany(CartItem::class);
	}

	public function roles()
	{
		return $this->belongsToMany(Role::class, 'user_role');
	}
}
