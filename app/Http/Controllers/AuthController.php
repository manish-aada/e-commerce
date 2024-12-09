<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Mail\RegistrationSuccess;



class AuthController extends Controller
{
	public function assignRole($userId, $roleId)
	{
		$user = User::findOrFail($userId);
		$role = Role::findOrFail($roleId);
		$user->roles()->attach($role);
	}

	public function register(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'name' => 'required|string',
			'address' => 'required|string',
			'contact' => 'required|string|max:10',
			'email' => 'required|email|unique:users',
			'username' => 'required|string|unique:users',
			'password' => 'required|string|min:6', 
			'role' => 'required|in:customer,vendor',
			'profile_picture' => 'nullable|image',
			'dob' => 'nullable|date',
		]);

		if ($validator->fails()) {
			return response()->json(['errors' => $validator->errors()], 422);
		}

		$profilePicturePath = null;
		if ($request->hasFile('profile_picture')) {
			$profilePicturePath = $request->file('profile_picture')->store('profile_pictures', 'public');
		}

		$user = User::create([
			'name' => $request->name,
			'address' => $request->address,
			'contact' => $request->contact,
			'email' => $request->email,
			'username' => $request->username,
			'password' => Hash::make($request->password),
			'profile_picture' => $profilePicturePath,
			'dob' => $request->dob,
			'role' => $request->role,
		]);

		$user->assignRole($request->role);

		Mail::to($user->email)->send(new RegistrationSuccess($user));

		return response()->json(['message' => 'Registration successful'], 201);
	}


	public function login(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'email' => 'required|email',
			'password' => 'required',
		]);

		if ($validator->fails()) {
			return response()->json([
				'errors' => $validator->errors()
			], 422);
		}

		if (Auth::attempt($request->only('email', 'password'))) {
			$user = Auth::user();
			return response()->json([
            'message' => 'Login successful',
            'userRole' => $user->role,
        	]);
		}

		return response()->json(['message' => 'Invalid credentials'], 401);
	}

	public function profile()
	{
		$user = Auth::user();
		return view('auth.profile', compact('user'));
	}

	public function updateProfile(Request $request)
	{
		$user = Auth::user();

		$request->validate([
			'name' => 'required|string|max:255',
			'address' => 'nullable|string|max:255',
			'contact' => 'nullable|string|max:15',
			'email' => 'required|email|unique:users,email,' . $user->id,
			'profile_picture' => 'nullable|image',
			'password' => 'nullable|min:8|confirmed',
		]);

		$user->name = $request->name;
		$user->address = $request->address;
		$user->contact = $request->contact;
		$user->email = $request->email;

		if ($request->hasFile('profile_picture')) {
			$path = $request->file('profile_picture')->store('profile_pictures', 'public');
			$user->profile_picture = $path;
		}

		if ($request->password) {
			$user->password = Hash::make($request->password);
		}

		$user->save();

		return back()->with('success', 'Profile updated successfully!');
	}

	public function logout(Request $request)
	{
		Auth::logout();

		$request->session()->invalidate();

		$request->session()->regenerateToken();

		return redirect()->route('home')->with('message', 'You have logged out successfully.');
	}
}
