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
        .status-complete { color: #28a745; }
        .status-pending { color: #ffc107; }
        .status-rejected { color: #dc3545; }
    </style>
</head>
<body>
    <h2>Funds Report</h2>
    
    <!-- Add summary information -->
    <div style="margin-bottom: 20px; padding: 10px; background-color: #f5f5f5; border: 1px solid #ddd;">
        <strong>Report Summary:</strong><br>
        Total Records: {{ $records->count() }}<br>
        Generated On: {{ now()->format('Y-m-d H:i:s') }}<br>
        @if(isset($request) && ($request->date_from || $request->date_to))
            Date Range: {{ $request->date_from ?? 'N/A' }} to {{ $request->date_to ?? 'N/A' }}<br>
        @endif
        @if(isset($request) && $request->search)
            Search Term: {{ $request->search }}<br>
        @endif
        @if(isset($request) && $request->status)
            Status: {{ $request->status == '0' ? 'Complete' : ($request->status == '1' ? 'Under Process' : 'Rejected') }}<br>
        @endif
        @if(isset($request) && $request->paymenttype)
            Payment Type: {{ ucfirst($request->paymenttype) }}<br>
        @endif
    </div>
    
    <table>
        <thead>
            <tr>
                <th>Sr. No.</th>
                <th>Agency Name</th>
                <th>Invoice</th>
                <th>Amount</th>
                <th>Added Date</th>
                <th>Payment Number</th>
                <th>Payment Method</th>
                <th>Payment Status</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($records as $index => $record)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $record->agency->name ?? 'N/A' }}</td>
                <td>{{ $record->invoice_number ?? 'N/A' }}</td>
                <td>{{ $record->amount ?? 'N/A' }}</td>
                <td>{{ $record->added_date ? \Carbon\Carbon::parse($record->added_date)->format('Y-m-d') : ($record->created_at ? $record->created_at->format('Y-m-d') : 'N/A') }}</td>
                <td>{{ $record->payment_number ?? 'N/A' }}</td>
                <td>{{ ucfirst($record->payment_type ?? 'N/A') }}</td>
                <td>
                    @php
                        $paymentstatus = $record->paymentstatus ?? null;
                        $paymentstatusText = $paymentstatus == '1' ? 'Pending' : ($paymentstatus == '0' ? 'Done' : 'Rejected');
                        $paymentstatusColor = $paymentstatus == '0' ? 'success' : ($paymentstatus == '1' ? 'danger' : 'warning');
                    @endphp
                    <span class="status-{{ $paymentstatusColor }}">{{ $paymentstatusText }}</span>
                </td>
                <td>
                    @php
                        $status = $record->status ?? null;
                        $statusText = $status == '0' ? 'Complete' : ($status == '1' ? 'Under Process' : 'Rejected');
                        $statusColor = $status == '0' ? 'success' : ($status == '1' ? 'warning' : 'danger');
                    @endphp
                    <span class="status-{{ $statusColor }}">{{ $statusText }}</span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
