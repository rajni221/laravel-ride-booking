<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Rides</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">
    <h2 class="text-center mb-4">All Ride Requests</h2>

    <table class="table table-bordered table-striped text-center shadow-sm">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Passenger</th>
                <th>Driver</th>
                <th>Status</th>
                <th>Requested At</th>
                <th>View Details</th>
            </tr>
        </thead>

        <tbody>
        @foreach($rides as $ride)
            <tr>
                <td>{{ $ride->id }}</td>
                <td>{{ $ride->passenger->name ?? 'N/A' }}</td>
                <td>{{ $ride->driver->name ?? 'Not Assigned' }}</td>
                <td>
                    <span class="badge bg-primary">
                        {{ ucfirst(str_replace('_',' ', $ride->status)) }}
                    </span>
                </td>
                <td>{{ $ride->created_at->format('d M, Y h:i A') }}</td>
                <td>
                    <a href="{{ url('admin/rides/' . $ride->id) }}" class="btn btn-info btn-sm">
                        View
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

</div>

</body>
</html>
