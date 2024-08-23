@extends('layouts.app')

@section('title', 'User: :Dashboard')

@section('content')
    <section class="my-5" style="min-height: calc(100vh - 250px);">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    @include('user.nav')
                </div>
                <div class="col-md-9">
                    <h2>Welcome to Dashboard</h2>
                    <p>In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate
                        the visual form of a document or a typeface without relying on meaningful content.</p>


                    <div class="d-flex align-items-center justify-content-center h-100">
                        <a href="{{ route('home') }}" class="btn btn-lg px-4 bg-primary-800 hover-primary-700 text-light">Find Bus and Buy
                            Ticket</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
