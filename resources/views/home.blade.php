@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="jumbotron">
            <h5>Welcome, {{ auth()->user()->email }}</h5>
            <h1 class="display-3">Bootstrap 4 Laravel Fortify Authentication</h1>
            <p class="lead">User is verified.</p>
        </div>
    </div>
@endsection
