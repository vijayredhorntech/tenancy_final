<!DOCTYPE html>
<html>
<head>
    <title>Agency Report</title>
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
    <p>This is an agency report generated</p>

    <table>
        <tr>
            <th>Sr. No.</th>
            <th>Agency Name</th>
            <th>Email</th>
            <th>Contact Person</th>
            <th>Services</th>
            <th>Fund Allotted</th>
            <th>Fund Remaining</th>
            <th>Status</th>
        </tr>

        @forelse($agencies as $agency)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $agency->name }}</td>
            <td>{{ $agency->email }}</td>
            <td>
                {{ $agency->contact_person }} <br>
                <small> {{ $agency->contact_phone }}</small>
            </td>
            <td>
                {{ $agency->userAssignments ? $agency->userAssignments->count() : 0 }}
            </td>
            <td>£ {{ $agency->balance ? $agency->balance->balance : '0' }}</td>
            <td>£ {{ $agency->balance ? $agency->balance->balance : '0' }}</td>
            <td>
                <span class="{{ $agency->details->status == '0' ? 'status-inactive' : 'status-active' }}">
                    {{ $agency->details->status == '0' ? 'Inactive' : 'Active' }}
                </span>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="8" style="text-align: center; font-weight: bold;">No Record Found</td>
        </tr>
        @endforelse
    </table>
</body>
</html>
