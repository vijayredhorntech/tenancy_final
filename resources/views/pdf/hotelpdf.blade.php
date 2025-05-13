<!DOCTYPE html>
<html>
<head>
    <title>Staff Report</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            text-align: center; 
        }
        h1 { 
            color: #333; 
            margin-bottom: 10px;
        }
        p {
            font-size: 14px;
            margin-bottom: 20px;
        }
        table { 
            width: 100%;
            border-collapse: collapse; 
            margin-top: 20px;
        }
        th, td { 
            border: 1px solid #ddd; 
            padding: 8px;
            text-align: left;
            font-size: 12px;
        }
        th {
            background-color: #f2f2f2;
            color: #333;
            font-weight: bold;
        }
        tr:nth-child(even) { 
            background-color: #f9f9f9; 
        }
        .status-active {
            background-color: #d4edda;
            color: #155724;
            padding: 5px;
            border-radius: 4px;
            font-weight: bold;
        }
        .status-inactive {
            background-color: #f8d7da;
            color: #721c24;
            padding: 5px;
            border-radius: 4px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>{{ $title }}</h1>
    <p>This is an Booking  report generated</p>

    <table>
        <tr>
            <th>Sr. No.</th>
            <th>Booking Number</th>
            <th>Agency Name</th>
            <th>Price</th>
            <th>Service Name</th>
            <th>Supplier Name</th>
            <th>Total Passenger</th>
            <th>Booking Date</th>
        
           
        </tr>


     @forelse($bookings as $booking)

        @php 
        $flight_name=json_decode($booking->flightBooking['details'], true);
        // Decode the JSON
        // First decode
        $passengers = json_decode(json_decode($booking->flightBooking->flightSearch, true), true);
        $totalPassengers = (int) ($passengers['adult'] ?? 0) + 
                                    (int) ($passengers['child'] ?? 0) + 
                                    (int) ($passengers['infant'] ?? 0);
        $flight_code=$flight_name[0]['journey'][0]['Carrier'];
        $carrier = \App\Models\Airline::where('iata', $flight_code)->first();
        $carrierName = $carrier ? $carrier->name : 'Unknown Carrier';

        @endphp
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{$booking['invoice_number']}}</td>
            <td>{{$booking->agency['name']}}</td>
            <td>
            £ {{$booking['amount']}}
               
            </td>
            <td>{{$booking->service_name['name']}}</td>
            <td>{{$carrierName}} </td>
            <td> {{$totalPassengers}} </td>
            <td>  {{$booking['date']}} </td>
          
        </tr>
        @empty
        <tr>
            <td colspan="8" style="text-align: center; font-weight: bold;">No Record Found</td>
        </tr>
        @endforelse
    </table>
</body>
</html>
