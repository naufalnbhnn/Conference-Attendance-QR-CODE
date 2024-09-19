<!DOCTYPE html>
<html>
<head>
    <title>Tambah Pengunjung</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-4">Tambah Pengunjung</h1>

        <form action="{{ route('visitor.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="affiliation">Affiliation:</label>
                <input type="text" id="affiliation" name="affiliation" class="form-control" placeholder="Kampus/Kantor/PT">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        <a href="{{ route('visitor.index') }}" class="btn btn-secondary mt-3">Kembali ke Daftar Pengunjung</a>
    </div>

    <!-- Bootstrap JavaScript (opsional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
