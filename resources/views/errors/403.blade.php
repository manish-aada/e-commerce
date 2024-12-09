@extends('layouts.app')

@section('title', 'Access Denied')

@section('content')
<div class="container text-center mt-5">
    <h1 class="display-4">403</h1>
    <p class="lead">You do not have the required permissions to access this page.</p>
    <a href="{{ route('home') }}" class="btn btn-primary">Return to Home</a>
</div>
@endsection
