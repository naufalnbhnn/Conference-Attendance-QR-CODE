<!DOCTYPE html>
<html>
<head>
    <title>Undangan Pengunjung</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-4">Undangan untuk {{ $visitor->name }}</h1>

        <!-- Card for Invitation -->
        <div class="card mb-4">
            <div class="card-body">
                <!-- Ucapan Pembuka -->
                <p>Kepada Yth. {{ $visitor->name }}</p>
                <p>Dengan hormat,</p>
                <p>Kami dengan senang hati mengundang Anda untuk menghadiri acara kami yang akan datang. Berikut adalah detail undangan Anda:</p>
                
                <!-- Data Pengunjung -->
                <hr>
                <p><strong>Name:</strong> {{ $visitor->name }}</p>
                <p><strong>Email:</strong> {{ $visitor->email }}</p>
                <p><strong>Affiliation:</strong> {{ $visitor->affiliation }}</p>
                <p><strong>QR Code:</strong></p>
                <div class="text-center">
                    {!! $qrCode !!}
                </div>

                <!-- Penutup -->
                <hr>
                <p>Terima kasih atas perhatian Anda. Kami berharap dapat bertemu dengan Anda di acara kami.</p>
                <p>Salam hormat,</p>
                <p>Tim Acara</p>
            </div>
        </div>

        <!-- Tombol untuk Salin Link dan Unduh HTML -->
        <div class="mb-3">
            <a href="{{ route('visitor.index') }}" class="btn btn-secondary no-print">Kembali ke Daftar Pengunjung</a>
            <button id="copyLink" class="btn btn-primary no-print">Salin Link</button>
            <a id="downloadButton" href="{{ route('visitor.downloadInvitation', $visitor->id) }}" class="btn btn-success no-print">Unduh HTML</a>
        </div>

    </div>

    <!-- Bootstrap JavaScript (opsional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- JavaScript untuk Salin Link -->
    <script>
        document.getElementById('copyLink').addEventListener('click', function() {
            const link = window.location.href; // Link saat ini
            navigator.clipboard.writeText(link).then(function() {
                alert('Link berhasil disalin ke clipboard!');
            }, function(err) {
                console.error('Gagal menyalin link: ', err);
            });
        });
    </script>
</body>
</html>
