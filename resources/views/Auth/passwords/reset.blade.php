@extends('Layout.auth')

@section('content')
    <div class="container" style="height: 100vh">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-md-6 col-lg-4">
                <div class="row mb-3">
                    <div class="mb-3 logo-login">
                        <img class="w-100 h-100 position-relative" src="{{ url('') }}/assets/images/logo/logoapi.png"
                            alt="">
                    </div>
                    <div class="fs-2 text-center">
                        {{ __('Reset Password') }}
                    </div>
                </div>
                <div class="row">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="">
                            <label for="email" class="col-12 col-form-label">{{ __('Email') }}</label>

                            <div class="col-12">
                                <input id="email" type="email"
                                    class="form-control disabled @error('email') is-invalid @enderror" name="email"
                                    required autocomplete="new-email" value="{{ $email ?? old('email') }}">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="">
                            <label for="password" class="col-12 col-form-label">{{ __('Password') }}</label>

                            <div class="col-12">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="password-confirm"
                                class="col-12 col-form-label">{{ __('Konfirmasi Password') }}</label>

                            <div class="col-12">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-12">
                                <button type="submit" class="btn btn-danger form-control">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
