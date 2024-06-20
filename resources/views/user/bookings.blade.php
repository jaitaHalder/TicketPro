@php use App\Helper; @endphp
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
                    <h2>Bookings</h2>
                    <div class="mt-4">
                        @if ($tickets->count() == 0)
                            <div class="alert alert-secondary rounded-0" role="alert">
                                You have not booked any seats yet. <a href="{{ route('home') }}" class="alert-link">Find
                                    Bus and Buy Ticket</a>
                            </div>
                        @endif

                        @foreach($tickets as $ticket)
                            <div class="row mb-4 bg-primary-200 rounded-1 py-4 position-relative">
                                <div class="col-12">
                                    <small class="ticket_created_at text-muted">{{ Helper::convertDateTime($ticket->created_at) }}</small>
                                    <div class="ticket-action-group">
                                        <a href="{{ route('user.bookings.print', $ticket->id) }}" target="_blank"
                                           class="btn btn-sm text-primary-800"><i class="fa fa-print"></i></a>
                                    </div>
                                </div>
                                <div class="customer-border-right col-md-4">
                                    <h4>{{ $ticket->trip->bus->bus_name }}</h4>
                                    <p class="my-1">
                                        <b>Model</b>
                                        <span>{{ $ticket->trip->bus->model }}</span>
                                    </p>
                                    <p class="my-1">
                                        <b>Capacity</b>
                                        <span>{{ $ticket->trip->bus->capacity }}</span>
                                    </p>
                                    <p class="my-1">
                                        <b class="d-block">Detail</b>
                                        {!! nl2br($ticket->trip->bus->detail) !!}
                                    </p>
                                </div>
                                <div class="customer-border-right col-md-4">
                                    <div>
                                        <strong class="text-success">
                                            {{ Helper::convertBookingDate($ticket->booking_date) }}
                                        </strong>
                                        <p class="my-1 d-flex justify-content-between">
                                            <b>Origin</b>
                                            <span>{{ $ticket->subRoute->originBusStop->name }}</span>
                                        </p>
                                        <p class="my-1 d-flex justify-content-between">
                                            <b>Destination</b>
                                            <span>{{ $ticket->subRoute->destinationBusStop->name }}</span>
                                        </p>
                                        <p class="my-1 d-flex justify-content-between">
                                            <b>Departure Time</b>
                                            <span>{{ Helper::convertTime($ticket->subRoute->departure_time) }}</span>
                                        </p>
                                        <p class="my-1 d-flex justify-content-between">
                                            <b>Arrival Time</b>
                                            <span>{{ Helper::convertTime($ticket->subRoute->arrival_time) }}</span>
                                        </p>
                                        <p class="my-1 d-flex justify-content-between">
                                            <b>Distance</b>
                                            <span>{{ number_format($ticket->subRoute->distance, 2) }} {{ Helper::LENGTH_UNIT }}</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="h-100 d-flex justify-content-between flex-column">
                                        <b>Seats</b>
                                        <p class="mb-1 mt-0 d-flex justify-content-between flex-row">
                                            <span>
                                                @foreach($ticket->seats as $seat)
                                                    <span class="badge bg-light text-dark">{{ $seat->seat_number }}</span>
                                                @endforeach
                                            </span>
                                        </p>

                                        <p class="mb-1 mt-0 d-flex justify-content-between">
                                            <b>Payment Method</b>
                                            <span>{{ $ticket->payment->payment_method }}</span>
                                        </p>

                                        @if ($ticket->payment->transaction_id)
                                            <p class="mb-1 mt-0 d-flex justify-content-between">
                                                <b>Transaction ID</b>
                                                <span>{{ $ticket->payment->transaction_id }}</span>
                                            </p>
                                        @endif

                                        <p class="mb-1 mt-0 d-flex justify-content-between">
                                            <b>Pre Ticket Price</b>
                                            <span>{{ number_format($ticket->subRoute->price, 2) }} {{ Helper::CURRENCY }}</span>
                                        </p>
                                        <p class="mb-1 mt-0 d-flex justify-content-between">
                                            <b>Subtotal</b>
                                            <span>{{ number_format($ticket->seats->count() * $ticket->subRoute->price, 2) }} {{ Helper::CURRENCY }}</span>
                                        </p>

                                        <p class="mb-1 mt-0 d-flex justify-content-between">
                                            <b>Payment</b>
                                            <span>{{ number_format($ticket->payment->amount, 2) }} {{ Helper::CURRENCY }}</span>
                                        </p>

                                        <p class="mb-1 mt-0 d-flex justify-content-between">
                                            <b>Payment Status</b>
                                            <span>{{ $ticket->payment->status }}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        @if ($tickets->count() > 0)
                            <div class="d-flex mt-5 justify-content-center">
                                <a href="{{ route('home') }}"
                                   class="btn btn-lg px-4 bg-primary-800 hover-primary-700 text-light">Find Bus and Buy
                                    Ticket</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
