<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Permissions Report</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid black; padding: 5px; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Permissions Report</h2>
    
    <!-- Add summary information -->
    <div style="margin-bottom: 20px; padding: 10px; background-color: #f5f5f5; border: 1px solid #ddd;">
        <strong>Report Summary:</strong><br>
        Total Records: {{ $permissions->count() }}<br>
        Generated On: {{ now()->format('Y-m-d H:i:s') }}<br>
        @if(isset($request) && $request->search)
            Search Term: {{ $request->search }}<br>
        @endif
    </div>
    
    <table>
        <thead>
            <tr>
                <th>Sr. No.</th>
                <th>Permission Name</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($permissions as $index => $permission)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ strtoupper($permission->name) }}</td>
                <td>{{ $permission->created_at ? $permission->created_at->format('Y-m-d H:i:s') : 'N/A' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
