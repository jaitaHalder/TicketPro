@extends("admin.layouts.master")
@section("title", "Admin Profile")
@section("content")
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Admin Profile</h1>
            <a href="{{ route("admin.auth.profile") }}"
               class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-sync fa-sm text-white-50"></i> Refresh</a>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <ul class="m-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session()->has("success"))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ session("success") }}
            </div>
        @endif

        @if (session()->has("error"))
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ session("error") }}
            </div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="{{ route("admin.auth.profile") }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <div class="form-group row mb-4">
                        <label for="name" class="col-sm-3 col-form-label text-right font-weight-bold">User's Name *</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="name" value="{{ $user->name }}"
                                   name="name">
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label for="email" class="col-sm-3 col-form-label text-right font-weight-bold">Email Address
                            *</label>
                        <div class="col-sm-6">
                            <input type="email" class="form-control" id="email"
                                   value="{{ $user->email }}" name="email">
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label for="" class="col-sm-3 col-form-label text-right font-weight-bold"></label>
                        <div class="col-sm-6">
                            <button type="submit" name="form" value="profile" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="{{ route("admin.auth.profile") }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <div class="form-group row mb-4">
                        <label for="old_password" class="col-sm-3 col-form-label text-right font-weight-bold">Old Password *</label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control" id="old_password"
                                   value="" name="old_password">
                            @error('old_password')
                            <p class="text-danger mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label for="password" class="col-sm-3 col-form-label text-right font-weight-bold">New Password *</label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control" id="password"
                                   value="" name="password">
                            @error('password')
                            <p class="text-danger mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label for="password_confirmation" class="col-sm-3 col-form-label text-right font-weight-bold">Confirm Password *</label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control" id="password_confirmation"
                                   value="" name="password_confirmation">
                            @error('password_confirmation')
                            <p class="text-danger mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label for="" class="col-sm-3 col-form-label text-right font-weight-bold"></label>
                        <div class="col-sm-6">
                            <button type="submit" name="form" value="password" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection