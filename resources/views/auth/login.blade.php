@extends('layouts.app')

@section('content')
            <div class="login-card">
              
                <img src="{{ url('assets/images/logo.png') }}" width="100" height="100" style="border-radius: 50%;margin-bottom:5px" />
                  <h2>{{ __('Lifeezi') }}</h2>
                    <form method="POST" class="login-form" action="{{ route('login') }}">
                        @csrf
                                <input id="email" type="email" class=" @error('email') is-invalid @enderror" name="email" placeholder="Email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <input id="password" type="password" class=" @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                @if (Route::has('password.request'))
                                    <a  href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif

                        
                                <button type="submit" >
                                    {{ __('Login') }}
                                </button>
                    </form>
                </div>
@endsection
