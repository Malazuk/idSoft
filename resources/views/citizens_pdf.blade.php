{{-- filepath: resources/views/citizens_pdf.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <title>Citizens Export</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; font-size: 12px; }
        th, td { border: 1px solid #333; padding: 4px; }
        th { background: #eee; }
    </style>
</head>
<body>
    <h2>Citizens Export</h2>
    <table>
        <thead>
            <tr>
                <th>Citizen ID</th>
                <th>First Name</th>
                <th>Surname</th>
                <th>Gender</th>
                <th>NIN</th>
                <th>Hometown</th>
                <th>Date of Birth</th>
                <th>Address</th>
            </tr>
        </thead>
        <tbody>
            @foreach($citizens as $citizen)
            <tr>
                <td>{{ $citizen->citizen_id }}</td>
                <td>{{ $citizen->first_name }}</td>
                <td>{{ $citizen->surname }}</td>
                <td>{{ $citizen->gender }}</td>
                <td>{{ $citizen->nin }}</td>
                <td>{{ $citizen->hometown }}</td>
                <td>{{ $citizen->date_of_birth }}</td>
                <td>{{ $citizen->address }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>