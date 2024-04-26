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
                    {{-- @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif --}}

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email"
                                class="col-12 col-form-label whitespace-nowrap">{{ __('Email') }}</label>

                            <div class="col-12">
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-12">
                                <button type="submit" class="btn btn-danger form-control">
                                    {{ __('Send Password Reset') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
