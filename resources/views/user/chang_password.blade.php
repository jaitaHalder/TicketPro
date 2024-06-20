@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <section class="my-5" style="min-height: calc(100vh - 250px);">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    @include('user.nav')
                </div>
                <div class="col-md-9">
                    <h2>Change Password</h2>

                    <div class="mt-4">
                        <form action="{{ route('user.change_password') }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-4 col-8">
                                <label for="old_password" class="form-label">Old Password*</label>
                                <input type="password" name="old_password" class="form-control form-control-lg"
                                       placeholder="Old Password" id="old_password" autofocus>
                                @error('old_password')
                                <p class="text-danger mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group mb-4 col-8">
                                <label for="password" class="form-label">New Password*</label>
                                <input type="password" name="password" class="form-control form-control-lg"
                                       placeholder="Old Password" id="password">
                                @error('password')
                                <p class="text-danger mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group mb-4 col-8">
                                <label for="password_confirmation" class="form-label">Confirm Password*</label>
                                <input type="password" name="password_confirmation" class="form-control form-control-lg"
                                       placeholder="Confirm Password" id="password_confirmation">
                                @error('password_confirmation')
                                <p class="text-danger mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <button class="btn btn-lg bg-primary-800 hover-primary-700 text-light">Change Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
