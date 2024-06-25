@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
    @include('banner', ['title' => 'Contact Us'])

    <section>
        <div class="container my-5">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="mt-2 mb-4">Contact Form</h3>
                    <form action="{{ route('contact_form_submit') }}" method="post">
                        @csrf
                        <label class="d-block">
                            <input type="text" name="name" class="form-control mt-4" id="name" value="{{ old('name') }}" placeholder="Your Name*" autofocus>
                            @error('name')
                            <span class="text-danger my-2">{{ $message }}</span>
                            @enderror
                        </label>

                        <label class="d-block">
                            <input type="text" name="email" class="form-control mt-4" id="email" value="{{ old('email') }}" placeholder="Email Address*">
                            @error('email')
                            <span class="text-danger my-2">{{ $message }}</span>
                            @enderror
                        </label>

                        <label class="d-block">
                            <input type="text" name="subject" class="form-control mt-4" id="name" value="{{ old('subject') }}" placeholder="Subject*">
                            @error('subject')
                            <span class="text-danger my-2">{{ $message }}</span>
                            @enderror
                        </label>

                        <label class="d-block">
                        <textarea name="message" class="form-control mt-4" placeholder="Message..."
                                  style="min-height: 200px">{{ old('message') }}</textarea>
                            @error('message')
                            <span class="text-danger my-2">{{ $message }}</span>
                            @enderror
                        </label>

                        <button class="btn bg-primary-800 hover-primary-700 text-light w-100 mt-4">Submit</button>
                    </form>
                </div>

                <div class="offset-lg-1 col-md-6 col-lg-5">
                    <h3 class="mt-2 mb-4">Contact Information</h3>

                    <div>
                        <div class="mb-4 bg-light p-4 rounded-2">
                            <b>Email Address</b>
                            <p>{!! $settings["CONTACT_EMAIL"] !!}</p>
                        </div>

                        <div class="mb-4 bg-light p-4 rounded-2">
                            <b>Phone Number</b>
                            <p>{!! $settings["CONTACT_PHONE"] !!}</p>
                        </div>

                        <div class="mb-4 bg-light p-4 rounded-2">
                            <b>Address</b>
                            <p>{!! $settings["CONTACT_ADDRESS"] !!}</p>
                        </div>

                        <div class="mb-4 p-4 rounded-2">
                            <div class="d-flex justify-content-between">
                                @if (!empty($settings["SETTING_SOCIAL_FACEBOOK"]))
                                    <a href="{{ $settings["SETTING_SOCIAL_FACEBOOK"] }}" class="text-decoration-none">
                                        <i class="fa-brands fa-facebook-f fa-2x" style="color: #3b5998;"></i>
                                    </a>
                                @endif

                                @if (!empty($settings["SETTING_SOCIAL_YOUTUBE"]))
                                    <a href="{{ $settings["SETTING_SOCIAL_YOUTUBE"] }}" class="text-decoration-none">
                                        <i class="fa-brands fa-youtube fa-2x" style="color: #ed302f;"></i>
                                    </a>
                                @endif

                                @if (!empty($settings["SETTING_SOCIAL_INSTAGRAM"]))
                                    <a href="{{ $settings["SETTING_SOCIAL_INSTAGRAM"] }}" class="text-decoration-none">
                                        <i class="fa-brands fa-instagram fa-2x" style="color: #ac2bac;"></i>
                                    </a>
                                @endif

                                @if (!empty($settings["SETTING_SOCIAL_LINKEDIN"]))
                                    <a href="{{ $settings["SETTING_SOCIAL_LINKEDIN"] }}" class="text-decoration-none">
                                        <i class="fa-brands fa-linkedin fa-2x" style="color: #0082ca;"></i>
                                    </a>
                                @endif

                                @if (!empty($settings["SETTING_SOCIAL_TWITTER"]))
                                    <a href="{{ $settings["SETTING_SOCIAL_TWITTER"] }}" class="text-decoration-none">
                                        <i class="fa-brands fa-twitter fa-2x" style="color: #55acee;"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mt-5">
        <!--Google map-->
        <div id="map-container-google-1" class="z-depth-1-half map-container">
            {!! $settings["CONTACT_GOOGLE_MAP"] !!}
        </div>

        <!--Google Maps-->
    </section>
@endsection