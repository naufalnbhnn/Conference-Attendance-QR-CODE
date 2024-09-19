<!DOCTYPE html>
<html>
<head>
    <title>QR Code Pengunjung</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-4">QR Code untuk {{ $visitor->name }}</h1>

        <div class="text-center mb-4">
            <!-- Pastikan $visitor->qr_code berisi HTML atau gambar QR Code -->
            {!! $visitor->qr_code !!}
        </div>

        <a href="{{ route('visitor.show', $visitor->id) }}" class="btn btn-secondary">Lihat Detail</a>
    </div>

    <!-- Bootstrap JavaScript (opsional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
