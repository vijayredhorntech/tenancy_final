<!DOCTYPE html>
<html>
<head>
    <title>Visa Booking Report</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        h2 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            border: 1px solid #333;
            padding: 6px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

    </style>
</head>
<body>

<h2>Visa Booking Report</h2>

<table>
    <thead>
        <tr>
            <th>Booking Number</th>
            <th>Client Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Price</th>
            <th>Visa Type</th>
            <th>Origin</th>
            <th>Destination</th>
            <th>Status</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach($bookings as $booking)
            <tr>
                <td>{{ $booking->application_number }}</td>
                @php
                $fullName = isset($booking->clint->client_name) && isset($booking->clint->client_name) && isset($booking->clint->client_name) 
                            ? $booking->clint->client_name 
                            : '';
                $cleanName = str_replace(',', '', $fullName);

                $email = isset($booking->clint) && isset($booking->clint) && isset($booking->clint->email) 
                        ? $booking->clint->email 
                        : '';

                $phone = isset($booking->clint) && isset($booking->clint) && isset($booking->clint->phone_number) 
                        ? $booking->clint->phone_number 
                        : '';
                @endphp
                <td>{{ $fullName }}</td>
                <td>{{ $email }}</td>
                <td>{{ $phone }}</td>
                <td>{{$booking->total_amount}}</td>
                <td>{{$booking->visa->name }}</td>
                <td>{{$booking->origin->countryName }}  </td>
                <td>{{$booking->destination->countryName }}</td>
                <td>{{ $booking->applicationworkin_status }}</td>
                <td>{{ $booking->created_at->format('Y-m-d') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
