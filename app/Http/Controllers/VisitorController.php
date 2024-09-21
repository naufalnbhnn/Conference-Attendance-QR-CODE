<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visitor;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use Barryvdh\DomPDF\Facade\Pdf;


class VisitorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Fungsi untuk menampilkan daftar pengunjung
    public function index()
    {
        $visitors = Visitor::all(); // Mengambil semua data pengunjung
        return view('visitor.index', compact('visitors')); // Menggunakan folder view 'visitor'
    }

    // Fungsi untuk menampilkan form pendaftaran pengunjung
    public function create()
    {
        return view('visitor.create'); // Menggunakan folder view 'visitor'
    }

    // Fungsi untuk menyimpan data pengunjung dan menampilkan QR code
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'affiliation' => 'nullable|string|max:255',
        ]);

        Visitor::create([
            'name' => $request->name,
            'email' => $request->email,
            'affiliation' => $request->affiliation, // Simpan kolom ini
        ]);

        return redirect()->route('visitor.index')->with('success', 'Visitor added successfully.');
    }

    // Fungsi untuk menampilkan QR code dan detail pengunjung
    public function show($id)
    {
        $visitor = Visitor::findOrFail($id);

        // Path ke logo yang akan digunakan
        $logoPath = public_path('img/BRIN-ID-07.png'); // Menggunakan public_path secara langsung

        // Cek apakah file logo ada
        if (file_exists($logoPath)) {
            // Generate QR code dengan logo di tengah
            $qrCode = QrCode::size(250)->generate(route('visitor.undangan', $id));

        } else {
            return response()->json(['error' => 'File logo tidak ditemukan.'], 404);
        }

        return view('visitor.show', compact('visitor', 'qrCode'));
    }

    public function scan(Request $request)
    {
        $visitor = Visitor::where('id', $request->input('id'))
            ->where('attended', false)
            ->first();

        if ($visitor) {
            $visitor->attended = true;
            $visitor->save();
            return response()->json(['status' => 'success', 'message' => 'Attendance marked.']);
        }

        return response()->json(['status' => 'error', 'message' => 'Invalid or already marked as attended.']);
    }

    public function invitation($id)
    {
        $visitor = Visitor::findOrFail($id);
        $qrCode = QrCode::size(250)->generate(route('visitor.undangan', $id)); // Ganti route sesuai kebutuhan
        return view('visitor.undangan', compact('visitor', 'qrCode'));
    }

    public function showScanPage()
    {
        return view('visitor.scan');
    }

    public function checkIn(Request $request)
    {
        // Cari pengunjung berdasarkan QR Code
        $visitor = Visitor::where('qr_code', $request->qr_code)->firstOrFail();

        // Tandai sebagai hadir dan catat waktu check-in
        $visitor->is_present = true;
        $visitor->check_in_time = now();
        $visitor->save();

        // Kembalikan data pengunjung sebagai JSON
        return response()->json([
            'success' => true,
            'visitor' => [
                'name' => $visitor->name,
                'email' => $visitor->email,
                'affiliation' => $visitor->affiliation,
                'check_in_time' => $visitor->check_in_time,
                'room' => 'Room 1' // Misalkan ini ditentukan dinamis
            ]
        ]);
    }

    public function downloadInvitation($id)
    {
        // Ambil data pengunjung dari database
        $visitor = Visitor::findOrFail($id);

        // Generate QR code
        $qrCode = QrCode::size(250)->generate(route('visitor.undangan', $id));

        // Generate HTML content untuk undangan
        $htmlContent = view('visitor.undangan', ['visitor' => $visitor, 'qrCode' => $qrCode])->render();

        // Tentukan nama file dan path
        $filename = 'invitation_' . $id . '.html';
        $path = storage_path('app/public/' . $filename);

        // Simpan HTML content ke file
        File::put($path, $htmlContent);

        // Kembalikan file sebagai unduhan
        return response()->download($path, $filename)->deleteFileAfterSend(true);
    }

    public function downloadPDF($id)
    {
        // Ambil data pengunjung dari database
        $visitor = Visitor::findOrFail($id);

        // Generate QR code dari route undangan
        $qrCode = QrCode::size(250)->generate(route('visitor.undangan', $id));

        // Load view undangan dan generate PDF
        $pdf = Pdf::loadView('visitor.undangan', ['visitor' => $visitor, 'qrCode' => $qrCode]);

        // Unduh PDF dengan nama file 'undangan_[id].pdf'
        return $pdf->download('undangan_' . $id . '.pdf');
    }
}
