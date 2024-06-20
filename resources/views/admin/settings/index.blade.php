@extends("admin.layouts.master")
@section("title", "Settings")
@section("content")
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Settings</h1>
            <a href="{{ route("admin.settings.index") }}"
               class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-sync fa-sm text-white-50"></i> Settings</a>
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

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="{{ route("admin.settings.update") }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <div class="form-group row">
                        <label for="SETTING_SITE_TITLE"
                               class="col-sm-3 col-form-label text-right font-weight-bold">Website Title</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="SETTING_SITE_TITLE"
                                   value="{{ $settings["SETTING_SITE_TITLE"] }}"
                                   name="SETTING_SITE_TITLE" autofocus>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="SETTING_SITE_DESCRIPTION" class="col-sm-3 col-form-label text-right font-weight-bold">Website Description</label>
                        <div class="col-sm-9">
                            <textarea name="SETTING_SITE_DESCRIPTION" id="SETTING_SITE_DESCRIPTION"
                                      class="form-control">{{ $settings["SETTING_SITE_DESCRIPTION"] }}</textarea>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label for="SETTING_SITE_LOGO"
                               class="col-sm-3 col-form-label text-right font-weight-bold">Logo</label>
                        <div class="col-sm-6">
                            <img src="{{ asset("storage/" . $settings["SETTING_SITE_LOGO"]) }}"
                                 alt="{{ $settings["SETTING_SITE_LOGO"] }}" width="150">
                            <input type="file" class="form-control mt-2" id="SETTING_SITE_LOGO" name="SETTING_SITE_LOGO">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="SETTING_SITE_FAVICON"
                               class="col-sm-3 col-form-label text-right font-weight-bold">Favicon</label>
                        <div class="col-sm-6">
                            <img src="{{ asset("storage/" . $settings["SETTING_SITE_FAVICON"]) }}"
                                 alt="{{ $settings["SETTING_SITE_FAVICON"] }}" width="150">
                            <input type="file" class="form-control mt-2" id="SETTING_SITE_FAVICON"
                                   name="SETTING_SITE_FAVICON">
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="SETTING_SOCIAL_FACEBOOK"
                               class="col-sm-3 col-form-label text-right font-weight-bold">Facebook URL</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="SETTING_SOCIAL_FACEBOOK"
                                   value="{{ $settings["SETTING_SOCIAL_FACEBOOK"] }}"
                                   name="SETTING_SOCIAL_FACEBOOK">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="SETTING_SOCIAL_YOUTUBE"
                               class="col-sm-3 col-form-label text-right font-weight-bold">Youtube URL</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="SETTING_SOCIAL_YOUTUBE"
                                   value="{{ $settings["SETTING_SOCIAL_YOUTUBE"] }}"
                                   name="SETTING_SOCIAL_YOUTUBE">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="SETTING_SOCIAL_INSTAGRAM"
                               class="col-sm-3 col-form-label text-right font-weight-bold">Instagram URL</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="SETTING_SOCIAL_INSTAGRAM"
                                   value="{{ $settings["SETTING_SOCIAL_INSTAGRAM"] }}"
                                   name="SETTING_SOCIAL_INSTAGRAM">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="SETTING_SOCIAL_LINKEDIN"
                               class="col-sm-3 col-form-label text-right font-weight-bold">Linkedin URL</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="SETTING_SOCIAL_LINKEDIN"
                                   value="{{ $settings["SETTING_SOCIAL_LINKEDIN"] }}"
                                   name="SETTING_SOCIAL_LINKEDIN">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="SETTING_SOCIAL_TWITTER"
                               class="col-sm-3 col-form-label text-right font-weight-bold">Twitter URL</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="SETTING_SOCIAL_TWITTER"
                                   value="{{ $settings["SETTING_SOCIAL_TWITTER"] }}"
                                   name="SETTING_SOCIAL_TWITTER">
                        </div>
                    </div>

                    <hr>

                    <div class="form-group row">
                        <label for="CONTACT_EMAIL"
                               class="col-sm-3 col-form-label text-right font-weight-bold">Contact Email</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="CONTACT_EMAIL"
                                   value="{{ $settings["CONTACT_EMAIL"] }}"
                                   name="CONTACT_EMAIL">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="CONTACT_PHONE"
                               class="col-sm-3 col-form-label text-right font-weight-bold">Contact Phone</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="CONTACT_PHONE"
                                   value="{{ $settings["CONTACT_PHONE"] }}"
                                   name="CONTACT_PHONE">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="CONTACT_ADDRESS"
                               class="col-sm-3 col-form-label text-right font-weight-bold">Contact Address</label>
                        <div class="col-sm-6">
                            <textarea name="CONTACT_ADDRESS" id="CONTACT_ADDRESS" class="form-control"
                                      style="min-height: 200px">{{ $settings["CONTACT_ADDRESS"] }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="CONTACT_GOOGLE_MAP"
                               class="col-sm-3 col-form-label text-right font-weight-bold">Contact Google Map</label>
                        <div class="col-sm-6">
                            <textarea name="CONTACT_GOOGLE_MAP" id="CONTACT_GOOGLE_MAP" class="form-control"
                                      style="min-height: 200px">{{ $settings["CONTACT_GOOGLE_MAP"] }}</textarea>
                        </div>
                    </div>

                    <hr>
                    <div class="form-group row">
                        <label for="SETTING_ABOUT_US" class="col-sm-3 col-form-label text-right font-weight-bold">About
                            Us</label>
                        <div class="col-sm-9">
                            <textarea name="SETTING_ABOUT_US" id="SETTING_ABOUT_US"
                                      class="form-control">{{ $settings["SETTING_ABOUT_US"] }}</textarea>
                        </div>
                    </div>

                    <hr>
                    <div class="form-group row">
                        <label for="PRIVACY_POLICY" class="col-sm-3 col-form-label text-right font-weight-bold">Privacy Policy</label>
                        <div class="col-sm-9">
                            <textarea name="PRIVACY_POLICY" id="PRIVACY_POLICY"
                                      class="form-control">{{ $settings["PRIVACY_POLICY"] }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="offset-3 col-sm-6">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection

@push("scripts")
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.2/tinymce.min.js" referrerpolicy="origin"></script>

    <script>
        tinymce.init({
            selector: '#SETTING_ABOUT_US',
            height: 400,
            plugins: 'advlist autolink lists link image charmap print preview anchor',
            toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | image link',
            menubar: false,
        });

        tinymce.init({
            selector: '#PRIVACY_POLICY',
            height: 400,
            plugins: 'advlist autolink lists link image charmap print preview anchor',
            toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | image link',
            menubar: false,
        });
    </script>
@endpush
