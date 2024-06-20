@php use App\Helper; @endphp
@extends("admin.layouts.master")
@section("title", "Contact Forms")
@section("content")
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Contact Forms</h1>
            <a href="{{ route("admin.contact_forms.index") }}"
               class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-sync fa-sm text-white-50"></i> Refresh</a>
        </div>

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
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th style="width: 50px">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($contactForms as $contactForm)
                            <tr>
                                <td style="width: 150px">{{ date('Y-m-d h:i A', strtotime($contactForm->created_at)) }}</td>
                                <td>{{ $contactForm->name }}</td>
                                <td>{{ $contactForm->email }}</td>
                                <td>{{ $contactForm->subject }}</td>
                                <td>{{ $contactForm->message }}</td>

                                <td>
                                    <form action="{{ route("admin.contact_forms.destroy", $contactForm->id) }}"
                                          method="post" class="d-inline">
                                        @csrf
                                        @method("DELETE")
                                        <button class="btn btn-sm" onclick="return confirm('Are you sure to delete?')">
                                            <i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
