@php use App\Helper; @endphp
@extends("admin.layouts.master")
@section("title", "Ticket Show")
@section("content")
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Ticket Show</h1>
            <a href="{{ route("admin.tickets.index") }}"
               class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-eye fa-sm text-white-50"></i> Tickets</a>
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
                <div class="accordion mb-5">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <button class="btn text-uppercase font-weight-bold" data-toggle="collapse" data-target="#item1" aria-expanded="true" aria-controls="item1">
                                    Passenger
                                </button>
                            </h5>
                        </div>

                        <div id="item1" class="collapse show">
                            <div class="card-body">
                                <table class="table table-borderless">
                                    <tr>
                                        <th class="w-25">Name</th>
                                        <td>{{ $ticket->user->name }}</td>
                                    </tr>
                                    <tr>
                                        <th class="w-25">Email</th>
                                        <td>{{ $ticket->user->email }}</td>
                                    </tr>
                                    <tr>
                                        <th class="w-25">Account Created</th>
                                        <td>{{ Helper::convertDateTime($ticket->user->created_at) }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion mb-5">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <button class="btn text-uppercase font-weight-bold" data-toggle="collapse" data-target="#item4" aria-expanded="true" aria-controls="item4">
                                    Price & Payment
                                </button>
                            </h5>
                        </div>

                        <div id="item4" class="collapse show">
                            <div class="card-body">
                                <table class="table table-borderless">
                                    <tr>
                                        <th class="w-25">Seats</th>
                                        <td>
                                            @foreach($ticket->seats as $seat)
                                                <span class="badge badge-info">{{ $seat->seat_number }}</span>
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="w-25">Payment Method</th>
                                        <td>{{ $ticket->payment->payment_method }}</td>
                                    </tr>

                                    @if ($ticket->payment->transaction_id)
                                        <tr>
                                            <th>Transaction ID</th>
                                            <td>{{ $ticket->payment->transaction_id }}</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <th class="w-25">Pre Ticket Price</th>
                                        <td>{{ number_format($ticket->subRoute->price, 2) }} {{ Helper::CURRENCY }}</td>
                                    </tr>
                                    <tr>
                                        <th class="w-25">Subtotal</th>
                                        <td>{{ number_format($ticket->subRoute->price * $ticket->seats->count(), 2) }} {{ $ticket->payment->currency }}</td>
                                    </tr>
                                    <tr>
                                        <th class="w-25">Payment</th>
                                        <td>{{ number_format($ticket->payment->amount, 2) }} {{ $ticket->payment->currency }}</td>
                                    </tr>
                                    <tr>
                                        <th class="w-25">Payment Status</th>
                                        <td>
                                            @if ($ticket->payment->status == 'Pending')
                                                <span class="badge badge-warning">Pending</span>
                                            @elseif($ticket->payment->status == 'Completed')
                                                <span class="badge badge-success">Completed</span>
                                            @else
                                                <span class="badge badge-danger">Failed</span>
                                            @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="w-25"></th>
                                        <td>
                                            <form action="{{ route('admin.tickets.update', $ticket->id) }}" method="post" class="d-flex">
                                                @csrf
                                                @method('PUT')
                                                <label for="status" class="d-inline"></label>
                                                <select name="status" id="status" class="form-control form-control-sm col-2 mr-2">
                                                    <option value="">Choose...</option>
                                                    <option value="Pending" @selected('Pending' == $ticket->payment->status)>Pending</option>
                                                    <option value="Completed" @selected('Completed' == $ticket->payment->status)>Completed</option>
                                                    <option value="Failed" @selected('Failed' == $ticket->payment->status)>Failed</option>
                                                </select>

                                                <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                            </form>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion mb-5">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <button class="btn text-uppercase font-weight-bold" data-toggle="collapse" data-target="#item2" aria-expanded="true" aria-controls="item2">
                                    Time Info
                                </button>
                            </h5>
                        </div>

                        <div id="item2" class="collapse show">
                            <div class="card-body">
                                <table class="table table-borderless">
                                    <tr>
                                        <th class="w-25">Ticket Created</th>
                                        <td>{{ Helper::convertDateTime($ticket->created_at) }}</td>
                                    </tr>
                                    <tr>
                                        <th class="w-25">Booking Date</th>
                                        <td>{{ Helper::convertBookingDate($ticket->booking_date) }}</td>
                                    </tr>
                                    <tr>
                                        <th class="w-25">Origin</th>
                                        <td>{{ $ticket->subRoute->originBusStop->name }}</td>
                                    </tr>
                                    <tr>
                                        <th class="w-25">Destination</th>
                                        <td>{{ $ticket->subRoute->destinationBusStop->name }}</td>
                                    </tr>
                                    <tr>
                                        <th class="w-25">Departure Time</th>
                                        <td>{{ Helper::convertTime($ticket->subRoute->departure_time) }}</td>
                                    </tr>
                                    <tr>
                                        <th class="w-25">Arrival Time</th>
                                        <td>{{ Helper::convertTime($ticket->subRoute->arrival_time) }}</td>
                                    </tr>
                                    <tr>
                                        <th class="w-25">Distance</th>
                                        <td>{{ $ticket->subRoute->distance }} {{ Helper::LENGTH_UNIT }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion mb-5">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <button class="btn text-uppercase font-weight-bold" data-toggle="collapse" data-target="#item3" aria-expanded="true" aria-controls="item3">
                                    Bus Inf
                                </button>
                            </h5>
                        </div>

                        <div id="item3" class="collapse show">
                            <div class="card-body">
                                <table class="table table-borderless">
                                    <tr>
                                        <th class="w-25">Bus Name</th>
                                        <td>{{ $ticket->trip->bus->bus_name }}</td>
                                    </tr>
                                    <tr>
                                        <th class="w-25">Model</th>
                                        <td>{{ $ticket->trip->bus->model }}</td>
                                    </tr>
                                    <tr>
                                        <th class="w-25">Detail</th>
                                        <td>{{ $ticket->trip->bus->detail }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection