@php use App\Helper; @endphp
        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ticket Information</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Sans+Mono:ital,wght@0,400..700;1,400..700&display=swap"
          rel="stylesheet">
    <style>
        * {
            font-family: "Ubuntu Sans Mono", monospace;
            font-optical-sizing: auto;
            font-weight: 400;
            font-style: normal;
        }

        .section {
            margin: 5px 0;
        }

        .section h3 {
            background-color: #fafafa;
            padding: 5px;
            border: 1px solid #efefef;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0;
        }

        th, td {
            border: 1px solid #efefef;
            text-align: left;
            padding: 3px 5px;
        }


        .heading {
            text-align: center;
        }
    </style>
</head>
<body>

<h1 class="heading">
    <img src="{{ asset('storage/' . Helper::setting('SETTING_SITE_LOGO')) }}" width="130" alt="">
    <br>
    {{ Helper::setting('SETTING_SITE_TITLE') }}
</h1>
<p class="heading">{{ Helper::setting('CONTACT_ADDRESS') }}</p>
<h4 class="heading" style="font-weight: 500;">Ticket Information</h4>


<div class="section">
    <h3>Passenger</h3>
    <table>
        <tr>
            <th>Name</th>
            <td>{{ $ticket->user->name }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $ticket->user->email }}</td>
        </tr>
    </table>
</div>

<div class="section">
    <h3>Time Info</h3>
    <table>
        <tr>
            <th>Ticket Created</th>
            <td>{{ Helper::convertDateTime($ticket->created_at) }}</td>
        </tr>
        <tr>
            <th>Booking Date</th>
            <td>{{ Helper::convertBookingDate($ticket->booking_date) }}</td>
        </tr>
        <tr>
            <th>Origin</th>
            <td>{{ $ticket->subRoute->originBusStop->name }}</td>
        </tr>
        <tr>
            <th>Destination</th>
            <td>{{ $ticket->subRoute->destinationBusStop->name }}</td>
        </tr>
        <tr>
            <th>Departure Time</th>
            <td>{{ Helper::convertTime($ticket->subRoute->departure_time) }}</td>
        </tr>
        <tr>
            <th>Arrival Time</th>
            <td>{{ Helper::convertTime($ticket->subRoute->arrival_time) }}</td>
        </tr>
        <tr>
            <th>Distance</th>
            <td>{{ $ticket->subRoute->distance }} {{ Helper::LENGTH_UNIT }}</td>
        </tr>
    </table>
</div>

<div class="section">
    <h3>Bus Info</h3>
    <table>
        <tr>
            <th>Bus Name</th>
            <td>{{ $ticket->trip->bus->bus_name }}</td>
        </tr>
        <tr>
            <th>Model</th>
            <td>{{ $ticket->trip->bus->model }}</td>
        </tr>
        <tr>
            <th>Detail</th>
            <td>{{ $ticket->trip->bus->detail }}</td>
        </tr>
    </table>
</div>


<div class="section">
    <h3>Price & Payment</h3>
    <table>
        <tr>
            <th>Seats</th>
            <td>
                @foreach($ticket->seats as $seat)
                    <span style="background: silver; border-radius: 2px; padding: 2px 5px;font-size: 12px">{{ $seat->seat_number }}</span>
                @endforeach
            </td>
        </tr>
        <tr>
            <th>Payment Method</th>
            <td>{{ $ticket->payment->payment_method }}</td>
        </tr>

        @if ($ticket->payment->transaction_id)
            <tr>
                <th>Transaction ID</th>
                <td>{{ $ticket->payment->transaction_id }}</td>
            </tr>
        @endif
        <tr>
            <th>Pre Ticket Price</th>
            <td>{{ number_format($ticket->subRoute->price, 2) }} {{ Helper::CURRENCY }}</td>
        </tr>
        <tr>
            <th>Subtotal</th>
            <td>{{ number_format($ticket->subRoute->price * $ticket->seats->count(), 2) }} {{ $ticket->payment->currency }}</td>
        </tr>
        <tr>
            <th>Payment</th>
            <td>{{ number_format($ticket->payment->amount, 2) }} {{ $ticket->payment->currency }}</td>
        </tr>
        <tr>
            <th>Payment Status</th>
            <td>{{ $ticket->payment->status }}</td>
        </tr>
    </table>
</div>

<p style="text-align: center;padding: 5px 0;">{{ Helper::COPYRIGHT }}</p>

@isset($print)
    <script>
       window.print();
    </script>
@endisset
</body>
</html>
