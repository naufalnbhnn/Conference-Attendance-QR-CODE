@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>Scan QR Code</h1>

        <!-- Kotak besar untuk scan QR Code -->
        <center>
            <div id="qr-reader" style="width: 500px;"></div>
            <div id="qr-reader-results"></div>
        </center>

        <!-- Menampilkan hasil setelah check-in -->
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Affiliation</th>
                    <th>Check-in Time</th>
                    <th>Room</th>
                </tr>
            </thead>
            <tbody id="visitor-info">
                <!-- Informasi akan ditampilkan di sini setelah berhasil check-in -->
            </tbody>
        </table>
    </div>

    <!-- Load HTML5 QR Code library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.8/html5-qrcode.min.js"></script>

    <script>
        // Fungsi untuk menangani hasil scan QR code
function onScanSuccess(decodedText, decodedResult) {
    // Log hasil pemindaian untuk debugging
    console.log('Decoded text:', decodedText);
    console.log('Decoded result:', decodedResult);

    // Kirim data ke server untuk check-in
    fetch('/api/check-in', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}' // Laravel CSRF token
        },
        body: JSON.stringify({ qr_code: decodedText })
    })
    .then(response => response.json())
    .then(data => {
        console.log('Server response:', data);
        if (data.success) {
            // Update tabel dengan informasi pengunjung
            document.getElementById('visitor-info').innerHTML = `
                <tr>
                    <td>${data.visitor.name}</td>
                    <td>${data.visitor.email}</td>
                    <td>${data.visitor.affiliation}</td>
                    <td>${data.visitor.check_in_time}</td>
                    <td>${data.visitor.room}</td>
                </tr>
            `;
        } else {
            alert('Check-in failed: ' + data.message);
        }
    })
    .catch(err => {
        console.error('Fetch error:', err);
        alert('An error occurred during check-in. ' + err.message);
    });
}


        // Mulai proses QR code scanning
        var html5QrCode = new Html5Qrcode("qr-reader");

        html5QrCode.start(
            { facingMode: "environment" },  // Kamera belakang
            { fps: 10, qrbox: 250 },        // Kecepatan scan dan ukuran kotak
            onScanSuccess
        ).catch(err => {
            console.error('Unable to start QR code scanner', err);
        });
    </script>
@endsection
