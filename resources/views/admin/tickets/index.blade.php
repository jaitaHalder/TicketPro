@extends("admin.layouts.master")
@section("title", "Tickets")
@section("content")
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tickets</h1>
            <a href="{{ route("admin.tickets.trashes") }}"
               class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-trash fa-sm text-white-50"></i> Trashes</a>
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
                    <table class="table table-bordered table-sm" id="dataTable">
                        <thead>
                        <tr>
                            <th>Booking Date</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>From-To</th>
                            <th>Bus</th>
                            <th>Payment Status</th>
                            <th style="width: 100px">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tickets as $ticket)
                            <tr>
                                <td>{{ $ticket->booking_date }}</td>
                                <td>{{ $ticket->user->name }}</td>
                                <td>{{ $ticket->user->email }}</td>
                                <td>{{ $ticket->subRoute->originBusStop->name }} - {{ $ticket->subRoute->destinationBusStop->name }}</td>
                                <td>{{ $ticket->trip->bus->bus_name }}</td>
                                <td>
                                    @if ($ticket->payment->status == 'Pending')
                                        <span class="badge badge-warning">Pending</span>
                                    @elseif($ticket->payment->status == 'Completed')
                                        <span class="badge badge-success">Completed</span>
                                    @else
                                        <span class="badge badge-danger">Failed</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.tickets.print', $ticket->id) }}" target="_blank" class="btn btn-sm"><i class="fa fa-print"></i></a>
                                    <a href="{{ route('admin.tickets.show', $ticket->id) }}" class="btn btn-sm"><i class="fa fa-edit"></i></a>

                                    <form action="{{ route('admin.tickets.destroy', $ticket->id) }}" method="post" class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm" onclick="return confirm('Are you confirm to delete?')"><i class="fa fa-trash"></i></button>
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