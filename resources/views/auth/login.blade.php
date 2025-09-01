@extends('layouts.app')

@section('title', 'Admin Login')

@section('content')
    <div class="row" style="margin-top: 40px; margin-bottom: 60px;">
        <div class="col s12 m8 l6 offset-m2 offset-l3">
            <div class="card z-depth-2">
                <div class="card-content">
                    <div class="center-align" style="margin-bottom: 16px;">
                        <img src="{{ asset('images/tup-logo.png') }}" alt="TUP Visayas"
                            style="height:56px; vertical-align:middle;">
                        <h5 style="margin-top: 12px; color:#C41E3A;">Administrator Login</h5>
                        <p class="grey-text text-darken-1" style="margin-top:4px;">Sign in to access the admin panel</p>
                    </div>

                    @if (session('status'))
                        <div class="card-panel green lighten-5" style="padding:10px 16px; border-left:4px solid #43a047;">
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
                                <span class="helper-text" style="color:#d32f2f;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="input-field">
                            <i class="material-icons prefix">lock</i>
                            <input id="password" type="password" name="password" required autocomplete="current-password">
                            <label for="password">Password</label>
                            @error('password')
                                <span class="helper-text" style="color:#d32f2f;">{{ $message }}</span>
                            @enderror
                        </div>

                        <p>
                            <label>
                                <input type="checkbox" name="remember" />
                                <span>Remember me</span>
                            </label>
                        </p>

                        <div class="section" style="margin-top: 16px;">
                            <div class="right-align">
                                @if (Route::has('password.request'))
                                    <a class="grey-text text-darken-1" href="{{ route('password.request') }}">Forgot your
                                        password?</a>
                                @endif
                            </div>
                        </div>

                        <div class="card-action" style="border-top: none; padding-left:0; padding-right:0;">
                            <button type="submit" class="btn waves-effect waves-light" style="width: 100%;">Log in</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="center-align" style="margin-top: 12px;">
                <a href="{{ route('home') }}" class="grey-text text-darken-1"><i class="material-icons tiny"
                        style="vertical-align:middle;">arrow_back</i> Back to home</a>
            </div>
        </div>
    </div>
@endsection