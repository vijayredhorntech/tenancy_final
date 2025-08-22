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

<!-- Add summary information -->
<div style="margin-bottom: 20px; padding: 10px; background-color: #f5f5f5; border: 1px solid #ddd;">
    <strong>Report Summary:</strong><br>
    Total Records: {{ $bookings->count() }}<br>
    Generated On: {{ now()->format('Y-m-d H:i:s') }}<br>
    @if(isset($request) && ($request->date_from || $request->date_to))
        Date Range: {{ $request->date_from ?? 'N/A' }} to {{ $request->date_to ?? 'N/A' }}<br>
    @endif
    @if(isset($request) && $request->search)
        Search Term: {{ $request->search }}<br>
    @endif
</div>



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

                // Fix date formatting with proper null checks
                $bookingDate = '';
                if (isset($booking->created_at) && $booking->created_at) {
                    try {
                        $bookingDate = $booking->created_at->format('Y-m-d');
                    } catch (Exception $e) {
                        $bookingDate = 'N/A';
                    }
                } else {
                    $bookingDate = 'N/A';
                }

                // Additional fallback: try to get date from different sources
                if ($bookingDate === 'N/A' && isset($booking->created_at)) {
                    if (is_string($booking->created_at)) {
                        $bookingDate = date('Y-m-d', strtotime($booking->created_at));
                    } elseif (is_object($booking->created_at) && method_exists($booking->created_at, 'format')) {
                        $bookingDate = $booking->created_at->format('Y-m-d');
                    } else {
                        $bookingDate = 'N/A';
                    }
                }
                @endphp
                <td>{{ $fullName }}</td>
                <td>{{ $email }}</td>
                <td>{{ $phone }}</td>
                <td>{{$booking->total_amount}}</td>
                <td>{{$booking->visa->name }}</td>
                <td>{{$booking->origin->countryName }}  </td>
                <td>{{$booking->destination->countryName }}</td>
                <td>{{ $booking->applicationworkin_status }}</td>
                <td>{{ $bookingDate }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
