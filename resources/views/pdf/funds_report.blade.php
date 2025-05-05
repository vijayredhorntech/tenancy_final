<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Funds Report</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid black; padding: 5px; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Funds Report</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Agency Name</th>
                <th>Amount</th>
                <th>Payment Type</th>
                <th>Status</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($records as $record)
            <tr>
                <td>{{ $record->id }}</td>
                <td>{{ $record->agency->name ?? 'N/A' }}</td>
                <td>{{ $record->amount }}</td>
                <td>{{ ucfirst($record->payment_type) }}</td>
                <td>{{ $record->status == 1 ? 'Under Process' : 'Complete' }}</td>
                <td>{{ $record->created_at->format('Y-m-d H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
