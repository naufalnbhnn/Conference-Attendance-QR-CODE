<!DOCTYPE html>
<html>
<head>
    <title>Check-in Data</title>
    <link rel="stylesheet" href="{{ public_path('LTE/plugins/bootstrap/css/bootstrap.min.css') }}">
    <style>
        .kop-surat {
            text-align: center;
            margin-bottom: 20px;
        }
        .kop-surat img {
            max-width: 100px; /* Sesuaikan ukuran logo */
        }
        .kop-surat h2, .kop-surat p {
            margin: 0;
        }
        hr {
            border: 1px solid black;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Kop Surat -->
        <div class="kop-surat" style="display: flex; align-items: center; justify-content: flex-start;">
        <img src="img/logo.png"  style="width: auto; height: auto; margin-right: 10px;">
        {{-- gambar belum bisa di load --}}
        <div>
            <h2>BADAN RISET & INOVASI NASIONAL</h2>
            <p>Dago, Bandung, Indonesia</p>
            <p>Email: info@instansi.com | Telepon: (021) 1234567</p>
            </div>
        </div>
        <hr>
    <div class="container">
        <h1>Check-in Data</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>ID Conference</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Affiliation</th>
                    <th>Check-in Time</th> 
                    <th>Room</th>
                </tr>
            </thead>
            <tbody>
                @foreach($checkInTimes as $checkIn)
                    <tr>
                        <td>{{ $checkIn->visitor->id_conference }}</td>
                        <td>{{ $checkIn->visitor->name }}</td>
                        <td>{{ $checkIn->visitor->email }}</td>
                        <td>{{ $checkIn->visitor->affiliation }}</td>
                        <td>{{ $checkIn->check_in_time }}</td>
                        <td>{{ $checkIn->room }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>