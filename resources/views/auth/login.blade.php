@extends('layouts.app')

@section('title', 'Admin Login')

@section('content')
    <div class="row site-auth">
        <div class="col s12 m8 l6 offset-m2 offset-l3">
            <div class="card z-depth-2 auth-card">
                <div class="card-content">
                    <div class="site-auth__header">
                        <img class="site-auth__logo" src="{{ asset('images/tup-logo.png') }}" alt="TUP Visayas">
                        <h1 class="site-auth__title">Administrator login</h1>
                        <p class="site-auth__lead">Sign in to access the admin panel</p>
                    </div>

                    @if (session('status'))
                        <div class="site-auth-flash" role="status">
                            <span class="green-text text-darken-2">{{ session('status') }}</span>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="input-field">
                            <i class="material-icons prefix">email</i>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                                autocomplete="username">
                            <label for="email">Email</label>
                            @error('email')
                                <span class="helper-text is-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="input-field">
                            <i class="material-icons prefix">lock</i>
                            <input id="password" type="password" name="password" required autocomplete="current-password">
                            <label for="password">Password</label>
                            @error('password')
                                <span class="helper-text is-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <p>
                            <label>
                                <input type="checkbox" name="remember" />
                                <span>Remember me</span>
                            </label>
                        </p>

                        <div class="section site-auth__extras">
                            <div class="right-align">
                                @if (Route::has('password.request'))
                                    <a class="grey-text text-darken-1" href="{{ route('password.request') }}">Forgot your
                                        password?</a>
                                @endif
                            </div>
                        </div>

                        <div class="card-action site-auth-actions">
                            <button type="submit" class="btn waves-effect waves-light site-btn-block">Log in</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="site-auth-footer">
                <a href="{{ route('home') }}" class="grey-text text-darken-1">
                    <i class="material-icons tiny">arrow_back</i> Back to home
                </a>
            </div>
        </div>
    </div>
@endsection
