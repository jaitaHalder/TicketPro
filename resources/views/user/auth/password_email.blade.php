@extends('layouts.app')

@section('title', 'Forgot Password')

@section('content')
    <section class="my-5 d-flex align-items-center" style="min-height: calc(100vh - 250px);">
        <div class="container">
            <div class="row">
                <div class="offset-4 col-4">
                    <h2 class="text-center">Forgot Password</h2>

                    <p class="text-danger text-center mt-2">
                        {{ session('error') }}
                    </p>

                    <form method="post" action="{{ route('password.email') }}">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="email"></label>
                            <input type="email" name="email" value="{{ old('email') }}"
                                   class="form-control form-control-lg" placeholder="Email Address" id="email"
                                   autofocus>
                            @error('email')
                            <p class="text-danger mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="mt-4 btn btn-lg bg-primary-800 hover-primary-700 text-light w-100">
                            Forgot Password
                        </button>

                        <p class="text-center mt-4 mb-4">
                            <a href="{{ route('user.login') }}" class="text-primary-800">Login</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
