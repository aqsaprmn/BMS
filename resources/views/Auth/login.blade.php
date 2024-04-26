@extends('Layout.auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-4 mt-5">
                <div class="mt-5">
                    <div class="mb-3 logo-login">
                        <img class="w-100 h-100 position-relative" src="{{ url('') }}/assets/images/logo/logoapi.png"
                            alt="">
                    </div>
                    <div class="fs-2 text-center">
                        {{ __('Log In') }}
                    </div>

                    <div class="p-4 rounded-1">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-2">
                                <label for="email" class="form-label mb-0">{{ __('Email') }}</label>
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" autocomplete="email" autofocus placeholder="Masukkan email">

                                @error('email')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label mb-0">{{ __('Password') }}</label>
                                <div class="password-eyes" id="password-eyes">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        autocomplete="current-password" placeholder="Masukkan password" value="">
                                    <span id="icon-eyes" class="icon-mid bi bi-eye eyes"></span>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Ingat saya') }}
                                    </label>
                                </div>
                            </div>

                            <div class="mb-0 text-center">
                                <button type="submit" class="btn btn-danger form-control mb-3">
                                    {{ __('Submit') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="text-secondary" href="{{ route('password.request') }}">
                                        {{ __('Lupa Password?') }}
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
