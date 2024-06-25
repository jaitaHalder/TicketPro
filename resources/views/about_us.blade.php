@extends('layouts.app')

@section('title', 'About Us')

@section('content')
    @include('banner', ['title' => 'About Us'])

    <div class="container">
        <div class="row">
            <div class="offset-2 col-8">
                <div class="mt-5">
                    {!! $about_us !!}
                </div>
            </div>
        </div>
    </div>
@endsection