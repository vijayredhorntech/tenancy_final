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
    <p>This is an Staff report generated</p>

    <table>
        <tr>
            <th>Sr. No.</th>
            <th>Employee Id</th>
            <th>Staff Name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Department</th>
            <th>Role</th>
           
        </tr>

        @forelse($users as $user)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>EMP-{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>
                {{ $user->email }} 
               
            </td>
            <td>{{ $user->userdetails->phone_number ?? 'N/A' }}</td>
            <td> </td>
            <td>   {{ $user->roles->isNotEmpty() ? $user->roles->pluck('name')->implode(', ') : 'No Role' }}</td>
          
        </tr>
        @empty
        <tr>
            <td colspan="8" style="text-align: center; font-weight: bold;">No Record Found</td>
        </tr>
        @endforelse
    </table>
</body>
</html>
