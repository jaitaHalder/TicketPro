@extends('layouts.app')

@section('title', 'New Password')

@section('content')
    <section class="my-5 d-flex align-items-center" style="min-height: calc(100vh - 250px);">
        <div class="container">
            <div class="row">
                <div class="offset-4 col-4">
                    <h2 class="text-center">Reset Password</h2>

                    <p class="text-danger text-center mt-2">
                        {{ session('error') }}
                    </p>

                    <form method="post" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="form-group mb-2">
                            <label for="email"></label>
                            <input id="email" type="email" placeholder="Email" class="form-control form-control-lg"
                                   name="email" value="{{ $email ?? old('email') }}" autofocus>

                            @error('email')
                            <p class="text-danger mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label for="password"></label>
                            <input id="password" type="password" placeholder="Password"
                                   class="form-control form-control-lg" name="password">

                            @error('password')
                            <p class="text-danger mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label for="password-confirm"></label>
                            <input id="password-confirm" type="password" class="form-control form-control-lg"
                                   name="password_confirmation" placeholder="Confirm Password">

                            @error('password_confirmation')
                            <p class="text-danger mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="mt-4 btn btn-lg bg-primary-800 hover-primary-700 text-light w-100">
                            Login
                        </button>

                        <p class="text-center mt-4 mb-4">
                            <a href="{{ route('password.request') }}" class="text-primary-800">Forgot Password</a>
                        </p>

                        <hr>

                        <small class="text-center mt-4 d-block">
                            Need an account? <a href="{{ route('user.signup') }}" class="text-primary-800">SIGN UP</a>
                        </small>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
