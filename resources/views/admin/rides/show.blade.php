<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ride Details</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <a href="{{ url('admin/rides') }}" class="btn btn-secondary mb-3">⬅ Back</a>

    <div class="card shadow">
        <div class="card-header bg-dark text-white">
            <h4>Ride #{{ $ride->id }} Details</h4>
        </div>

        <div class="card-body">

            <div class="row mb-3">
                <div class="col-md-6">
                    <strong>Passenger:</strong>
                    <p>{{ $ride->passenger->name }}</p>
                </div>
                <div class="col-md-6">
                    <strong>Driver:</strong>
                    <p>{{ $ride->driver->name ?? 'Not Assigned' }}</p>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <strong>Pickup Coordinates:</strong>
                    <p>{{ $ride->pickup_lat }}, {{ $ride->pickup_lng }}</p>
                </div>
                <div class="col-md-6">
                    <strong>Destination Coordinates:</strong>
                    <p>{{ $ride->dest_lat }}, {{ $ride->dest_lng }}</p>
                </div>
            </div>

            <div class="mb-3">
                <strong>Current Status:</strong>
                <p>
                    <span class="badge bg-success">
                        {{ ucfirst(str_replace('_',' ', $ride->status)) }}
                    </span>
                </p>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <strong>Created At:</strong>
                    <p>{{ $ride->created_at->format('d M, Y h:i A') }}</p>
                </div>
                <div class="col-md-6">
                    <strong>Updated At:</strong>
                    <p>{{ $ride->updated_at->format('d M, Y h:i A') }}</p>
                </div>
            </div>

        </div>
    </div>

</div>

</body>
</html>
