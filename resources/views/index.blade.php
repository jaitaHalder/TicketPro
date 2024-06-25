@php use App\Helper; @endphp
@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <section class="main" style="background-image: url('{{ asset('cover2.jpg') }}')">
        <div class="overlay">
            <!-- Add any content you want within the overlay here -->
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-center">
                            <h1 class="display-4">{{ Helper::setting('SETTING_SITE_TITLE') }}</h1>
                            <p class="lead">{{ Helper::setting('SETTING_SITE_DESCRIPTION') }}</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label for="origin"></label>
                        <select name="origin" id="origin" class="form-select form-select-lg">
                            <option value="">Choose Origin</option>
                            @foreach($origins as $origin)
                                <option value="{{ $origin->originBusStop->id }}" @selected($origin->originBusStop->id == request()->input('origin'))>{{ $origin->originBusStop->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="destination"></label>
                        <select name="destination" id="destination" class="form-select form-select-lg">
                            <option value="">Choose Destination</option>
                            @foreach($destinations as $destination)
                                <option value="{{ $destination->destinationBusStop->id }}" @selected($destination->destinationBusStop->id == request()->input('destination'))>{{ $destination->destinationBusStop->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="date"></label>
                        <input type="date" name="date" id="date" value="{{ request()->input('date') ?? $date }}" min="<?= date('Y-m-d'); ?>"
                               class="form-control form-control-lg">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex justify-content-center mt-5">
                            <div class="d-flex flex-column">
                                <button id="search" class="btn bg-primary-800 hover-primary-700 btn-lg text-white px-5">
                                    SEARCH BUS
                                </button>

                                <button id="clear" class="btn bg-transparent text-light btn-sm px-5 mt-4">CLEAR
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if (!request()->input('origin'))
    <section class="my-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h3 class="font-weight-bold text-success my-4 py-2 border-top border-bottom">Buy bus tickets in 3 easy steps</h3>
                </div>

                <div class="col-md-4 d-flex mb-3">
                    <div class="col-md-3 d-flex justify-content-center align-items-center bg-light h-100 me-2">
                        <i class="fa fa-search fa-3x text-success"></i>
                    </div>
                    <div class="col-md-9">
                        <h4 class="font-weight-bold text-success mt-0">Search</h4>
                        <div>
                            Choose your origin, destination, journey dates and search for buses
                        </div>
                    </div>
                </div>

                <div class="col-md-4 d-flex mb-3">
                    <div class="col-md-3 d-flex justify-content-center align-items-center bg-light h-100 me-2">
                        <i class="fa fa-bus fa-3x text-success"></i>
                    </div>
                    <div class="col-md-9">
                        <h4 class="font-weight-bold text-success mt-0">Select</h4>
                        <div>
                            Select your desired bus and choose your seats
                        </div>
                    </div>
                </div>

                <div class="col-md-4 d-flex mb-3">
                    <div class="col-md-3 d-flex justify-content-center align-items-center bg-light h-100 me-2">
                        <i class="fa fa-money-bill fa-3x text-success"></i>
                    </div>
                    <div class="col-md-9">
                        <h4 class="font-weight-bold text-success mt-0">Pay</h4>
                        <div>
                            Pay by bKash, Nagad or Cash
                        </div>
                    </div>
                </div>

                <div class="col-md-12 text-center mt-4">
                    <div class="col-md-12">
                        <div class="d-flex justify-content-center align-items-center bg-light p-3 border rounded">
                            <i class="fa fa-lock text-success mr-2 fa-lg"></i>&nbsp;Safe and Secure online payments
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <section class="py-5" id="bus-list">
        <div class="container">
            <div class="row">
                <div class="col-md-12 bg-primary-100 mb-5">
                    <div class="row py-2">
                        <div class="col-3"><b>Your Search</b></div>
                        <div class="col-3">
                            <b>From:</b>
                            <span>
                                @if ($search['origin'])
                                    {{ $search['origin']->name }}
                                @else
                                    -
                                @endif
                            </span>
                        </div>
                        <div class="col-3">
                            <b>To:</b>
                            <span>
                                @if ($search['destination'])
                                    {{ $search['destination']->name }}
                                @else
                                    -
                                @endif
                            </span>
                        </div>
                        <div class="col-3">
                            <b>Date:</b>
                            <span>
                                @if ($search['date'])
                                    {{ $search['date'] }}

                                @else
                                    -
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            @if ($routes->count())
                @foreach($routes as $route)
                    @continue($route->trip == null)
                    <div class="row mb-4 bg-primary-200 rounded-1 py-4">
                        <div class="customer-border-right offset-1 col-md-4">
                            <h4>{{ $route->trip->bus->bus_name }}</h4>
                            <p class="my-1">
                                <b>Model</b>
                                <span>{{ $route->trip->bus->model }}</span>
                            </p>
                            <p class="my-1">
                                <b>Capacity</b>
                                <span>{{ $route->trip->bus->capacity }}</span>
                            </p>
                            <p class="my-1">
                                <b class="d-block">Detail</b>
                                {!! nl2br($route->trip->bus->detail) !!}
                            </p>
                        </div>
                        <div class="customer-border-right col-md-3">
                            <div>
                                <p class="my-1 d-flex justify-content-between">
                                    <b>Departure Time</b>
                                    <span>{{ Helper::convertTime($route->departure_time) }}</span>
                                </p>
                                <p class="my-1 d-flex justify-content-between">
                                    <b>Arrival Time</b>
                                    <span>{{ Helper::convertTime($route->arrival_time) }}</span>
                                </p>
                                <p class="my-1 d-flex justify-content-between">
                                    <b>Distance</b>
                                    <span>{{ number_format($route->distance, 2) }} {{ Helper::LENGTH_UNIT }}</span>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="h-100 d-flex justify-content-between flex-column">
                                <p class="my-1 d-flex justify-content-between">
                                    <b>Price</b>
                                    <span>{{ $route->price }} {{ Helper::CURRENCY }}</span>
                                </p>
                                @auth('web')
                                    <a href="{{ route('user.seat_book') . request()->getRequestUri() . "&bus={$route->trip->bus->id}" }}"
                                       class="mt-4 btn btn-lg bg-primary-800 hover-primary-700 text-light w-100">BOOK
                                        NOW</a>
                                @else
                                    <a href="{{ route('user.login') . request()->getRequestUri() . "&bus={$route->trip->bus->id}" }}"
                                       class="mt-4 btn btn-lg bg-primary-800 hover-primary-700 text-light w-100">BOOK
                                        NOW</a>
                                @endauth
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                @if ($search['origin'] == null && $search['destination'] == null)
                    <h3 class="text-center text-uppercase">Please search bus</h3>
                @else
                    <h3 class="text-center text-uppercase text-danger">Search result not found</h3>
                @endif
            @endif
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        const originElement = $('#origin');
        const destinationElement = $('#destination');
        const dateElement = $('#date');
        const searchButtonElement = $('#search');
        const clearButtonElement = $('#clear');

        const optionChoose = () => {
            const origin = originElement.val();
            const destination = destinationElement.val();
            const date = dateElement.val();

            const queryParams = {
                origin: origin,
                destination: destination,
                date: date
            };

            window.location.href = location.origin + '?' + new URLSearchParams(queryParams).toString();
        }

        const searchBus = () => {
            const uri = new URLSearchParams(location.search);


            if (uri.get('origin') === '' || uri.get('destination') === '' || uri.get('date') === '') {
                alert('Please choose origin and destination');
                return 0;
            }

            $('html, body').animate({
                scrollTop: $("#bus-list").offset().top
            }, 500);
        }

        originElement.change(function () {
            optionChoose();
        });

        destinationElement.change(function () {
            optionChoose();
        });

        dateElement.change(function () {
            optionChoose();
        });

        clearButtonElement.click(function () {
            window.location.href = location.origin;
        });

        searchButtonElement.click(function () {
            searchBus();
        });
    </script>
@endpush