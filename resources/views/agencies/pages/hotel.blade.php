<x-agency.layout>
    @section('title')
        Agency
    @endsection

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Denied</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background: url('https://source.unsplash.com/1600x900/?hotel,resort,luxury') no-repeat center center/cover;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            background: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
        }
        h1 {
            color: #ff4d4d;
            font-size: 2.5rem;
        }
        p {
            font-size: 1.2rem;
        }
    </style>
</head>
<body>

@php
$segment = request()->segment(2); // Gets the second segment of the URL
@endphp
    <div class="container">
        <h1>Access Denied</h1>
        <p>You do not have permission to access this {{$segment}} Service.</p>
    </div>
</body>
</html>
    </x-agency.layout>

