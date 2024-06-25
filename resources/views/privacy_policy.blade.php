@extends('layouts.app')

@section('title', 'Privacy Policy')

@section('content')
    @include('banner', ['title' => 'Privacy Policy'])

    <div class="container">
        <div class="row">
            <div class="offset-2 col-8">
                <div class="mt-5">
                    {!! $privacy_policy !!}
                </div>
            </div>
        </div>
    </div>
@endsection