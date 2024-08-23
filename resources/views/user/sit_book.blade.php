@php use App\Helper; @endphp
@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    {!! $emailVerificationLink !!}
                </div>
            </div>

            <form action="{{ route('user.seat_book') }}" id="form" method="post">
                @csrf
                <input type="hidden" name="trip_id" value="{{ $route->trip_id }}">
                <input type="hidden" name="origin" value="{{ $route->originBusStop->id }}">
                <input type="hidden" name="destination" value="{{ $route->destinationBusStop->id }}">
                <input type="hidden" name="date" value="{{ request()->input('date') }}">
                <div class="row">
                    <div class="offset-2 col-md-4">
                        <div class="d-flex justify-content-between mb-4">
                            <div style="background: #27ae60; color: #ffffff; height: 80px; width: 80px; border-radius: 5px" class="d-flex align-items-center justify-content-center">
                                <small class="text-center fw-light d-block">Available</small>
                            </div>
                            <div style="background: #e74c3c; color: #ffffff; height: 80px; width: 80px; border-radius: 5px" class="d-flex align-items-center justify-content-center">
                                <small class="text-center fw-light d-block">Reserved</small>
                            </div>
                            <div style="background: #2980b9; color: #ffffff; height: 80px; width: 80px; border-radius: 5px" class="d-flex align-items-center justify-content-center">
                                <small class="text-center fw-light d-block">Selected</small>
                            </div>
                            @if ($emailVerificationLink)
                                <div style="background: #34495e; color: #ffffff; height: 80px; width: 80px; border-radius: 5px" class="d-flex align-items-center justify-content-center">
                                    <img src="{{ asset('seat_disabled.png') }}" alt="" width="80">
                                    <small class="text-center fw-light d-block">Disabled</small>
                                </div>
                            @endif
                        </div>
                        <div class="bus-layout" id="bus_seat">
                            @for($i = 1; $i <= $route->trip->bus->capacity; $i++)
                                @if ($emailVerificationLink)
                                    <input type="checkbox" name="seats[]" id="seat{{ $i }}" value="{{ $i }}"
                                           class="seat-checkbox" disabled>
                                    <label for="seat{{ $i }}" class="seat disabled">{{ $i }}</label>
                                @else
                                    @if (in_array($i, $ticketSeats))
                                        <input type="checkbox" name="seats[]" id="seat{{ $i }}" value="{{ $i }}"
                                               class="seat-checkbox" disabled>
                                        <label for="seat{{ $i }}" class="seat reserved">{{ $i }}</label>
                                    @else
                                        @if (is_array(old('seats')) && in_array($i, old('seats')))
                                            <input type="checkbox" name="seats[]" id="seat{{ $i }}" value="{{ $i }}"
                                                   class="seat-checkbox seat-available" checked>
                                            <label for="seat{{ $i }}" class="seat available">{{ $i }}</label>
                                        @else
                                            <input type="checkbox" name="seats[]" id="seat{{ $i }}" value="{{ $i }}"
                                                   class="seat-checkbox seat-available">
                                            <label for="seat{{ $i }}" class="seat available">{{ $i }}</label>
                                        @endif
                                    @endif
                                @endif
                            @endfor
                        </div>
                    </div>

                    <div class="offset-1 col-md-3">
                        <h4 class="mt-2">{{ $bus->bus_name }} <h6 class="text-muted">Model: {{ $bus->model }}</h6></h4>
                        <div class="d-flex flex-column">
                            <p class="my-1 d-flex justify-content-between">
                                {!! nl2br($bus->detail) !!}
                            </p>
                            <hr>
                            <p class="my-1 d-flex justify-content-between">
                                <span>Starting Point</span>
                                <span>
                                {{ $search['origin']->name }}
                            </span>
                            </p>
                            <p class="my-1 d-flex justify-content-between">
                                <span>End Point</span>
                                <span>
                                {{ $search['destination']->name }}
                            </span>
                            </p>
                            <p class="my-1 d-flex justify-content-between">
                                <span>Departure Time</span>
                                <span>{{ Helper::convertTime($route->departure_time) }}</span>
                            </p>
                            <p class="my-1 d-flex justify-content-between">
                                <span>Arrival Time</span>
                                <span>{{ Helper::convertTime($route->arrival_time) }}</span>
                            </p>
                            <p class="my-1 d-flex justify-content-between">
                                <span>Date</span>
                                <span>
                                {{ $search['date'] }}
                            </span>
                            </p>

                            <p class="my-1 d-flex justify-content-between mt-4">
                                <span>Select Sit Number</span>
                                <span id="selected-seats">-</span>
                            </p>

                            <p class="my-1 d-flex justify-content-between mt-2">
                                <span>Pre Ticket Price</span>
                                <span>{{ number_format($route->price, 2) }} {{ Helper::CURRENCY }}</span>
                            </p>

                            <p class="my-1 d-flex justify-content-between mt-2">
                                <span>Subtotal</span>
                                <span><span id="subtotal">0.00</span> {{ Helper::CURRENCY }}</span>
                            </p>

                            <hr>

                            <div class="my-1 d-flex flex-column mt-2">
                                <b>Payment Method</b>
                                <p class="d-block text-secondary m-0" style="font-size: 12px">
                                    If you make a payment through bKash or Nagad, please collect the transaction ID.
                                </p>
                                <div>
                                    <img src="{{ asset('payment_method.png') }}" class="img-fluid" width="120" alt="">
                                    <img src="{{ asset('payment_method_cash.webp') }}" class="img-fluid mt-1" width="55" alt="">
                                </div>

                                <div class="mt-2">
                                    <div class="form-check">
                                        <input class="form-check-input payment-method" type="radio"
                                               name="payment_method" value="bKash"
                                               id="bkash" @checked('bKash' == old('payment_method'))>
                                        <label class="form-check-label" for="bkash">bKash (01707093920)</label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input payment-method" type="radio"
                                               name="payment_method" value="Nagad"
                                               id="nagad" @checked('Nagad' == old('payment_method'))>
                                        <label class="form-check-label" for="nagad">Nagad (01912275418)</label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input payment-method" type="radio"
                                               name="payment_method" value="Cash"
                                               id="cash" @checked('Cash' == old('payment_method'))>
                                        <label class="form-check-label" for="cash">Cash</label>
                                    </div>

                                    <div class="form-group">
                                        <label for="transaction_id"></label>
                                        <input type="text" class="form-control" value="{{ old('transaction_id') }}"
                                               name="transaction_id" id="transaction_id" placeholder="Transaction ID">
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-lg bg-primary-800 hover-primary-700 text-white mt-4">BUY TICKET
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        const selectedSeatsAndSubtotal = () => {
            let selectedSeats = '';
            let preTicketPrice = {{ $route->price }};
            let count = 0;

            $('.seat-available').each(function () {
                const seat = $(this);

                if (seat.prop('checked')) {
                    selectedSeats += `<span class="badge bg-light text-dark">${seat.val()}</span>`;
                    count++;
                }
            });

            const subtotal = preTicketPrice * count;

            $('#selected-seats').html(selectedSeats);
            $('#subtotal').html(subtotal.toFixed(2));
        }

        const transactionId = () => {
            let showTransactionId = false;
            let methodVal = '';

            $('.payment-method').each(function () {
                const method = $(this);

                if (method.prop('checked') && (method.val() === 'bKash' || method.val() === 'Nagad')) {
                    methodVal = method.val();
                    showTransactionId = true;
                    return false;
                }
            });

            if (showTransactionId) {
                let placeholder = 'Transaction ID';

                if (methodVal === 'bKash') {
                    placeholder = 'bKash Transaction ID';
                } else if (methodVal === 'Nagad') {
                    placeholder = 'Nagad Transaction ID';
                }

                $('#transaction_id')
                    .prop('placeholder', placeholder)
                    .show()
                    .focus();
            } else {
                $('#transaction_id').hide();
            }
        };

        $(document).ready(function () {
            selectedSeatsAndSubtotal();
            transactionId();

            $('.seat-available').on('input', function () {
                selectedSeatsAndSubtotal();
            });

            $('.payment-method').each(function () {
                $(this).on('click', function() {
                    transactionId();
                })
            });
        });
    </script>
@endpush
