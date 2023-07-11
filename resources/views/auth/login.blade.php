@extends('auth.layouts.base')

@section('contents')
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <form method="post" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input
                type="email"
                class="form-control"
                id="email"
                aria-describedby="emailHelp"
                name="email"
                required
                autofocus
                autocomplete="username"
                value="{{ old('email') }}"
            >
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input
                type="password"
                class="form-control"
                id="password"
                name="password"
                required
                autocomplete="current-password"
            >
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="remember" name="remember">
            <label class="form-check-label" for="remember">Remember me</label>
        </div>

        <div class="row g-3">
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>

            <div class="col-6">
                <a class="col-6 text-sm-center" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            </div>

            <div class="col-6">
                <a class="col-6" href="{{ route('register') }}">
                    {{ __('No account? Register') }}
                </a>
            </div>

        </div>


    </form>


@endsection

