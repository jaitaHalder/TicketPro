@extends('layouts.app')

@section('title', 'Privacy Policy')

@section('content')
    <div class="banner-area d-flex align-items-center"
         style="background-image:url('{{ asset("banner1.jpg") }}');">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="banner-text">
                        <h1 class="text-center">Privacy Policy</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

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