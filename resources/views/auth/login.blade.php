@extends('layouts.app')

<style>
    /* Centering the form in the middle of the screen */
    .login-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh; /* Full viewport height */
    }

    .card {
        width: 100%;
        max-width: 400px; /* Max width for the card */
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-control {
        border-radius: 5px;
    }

    .btn {
        width: 100%;
        padding: 10px;
    }

    .alert {
        margin-bottom: 15px;
    }
</style>

@section('content')

<div class="login-container">
    <div class="card">
        <h3 class="text-center mb-4">Login</h3>

        <!-- Menampilkan pesan error jika ada -->
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Menampilkan pesan error dari validasi -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="loginForm" method="POST" action="{{ route('login') }}">
    @csrf

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="form-control" required 
               placeholder="Masukkan email Anda">
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" class="form-control" required 
               placeholder="Masukkan password Anda">
    </div>

    <button type="submit" class="btn btn-primary">Login</button>
</form>

    </div>
</div>

@endsection
