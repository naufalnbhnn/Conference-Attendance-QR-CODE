@extends('layouts.app')

@section('style')
<!-- DataTables -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
<div class="container mt-4">
    <h1>Daftar Pengunjung</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('visitor.create') }}" class="btn btn-primary mb-3">Tambah Pengunjung</a>
    <a href="{{ route('visitor.download') }}" class="btn btn-primary mb-3">Download Data</a>
    <a href="{{ route('visitor.scan') }}" class="btn btn-primary mb-3">Scan QR Code</a>

    <!-- Tabel Data Pengunjung -->
    <table id="visitortable" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>ID Conference</th>
                <th>Name</th>
                <th>Email</th>
                <th>Affiliation</th>
                <th>QR Code</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($visitors as $visitor)
                <tr>
                    <td>{{ $visitor->id_conference }}</td>
                    <td>{{ $visitor->name }}</td>
                    <td>{{ $visitor->email }}</td>
                    <td>{{ $visitor->affiliation }}</td>
                    <td class="text-center">
                        <div>
                            {!! QrCode::size(100)->margin(2)->generate(route('visitor.show', $visitor->id)) !!}
                            <div class="mt-2">
                                <a href="{{ route('visitor.downloadQrCode', $visitor->id) }}" class="btn btn-primary mt-2">Download QR Code</a>
                            </div>
                        </div>
                    </td>
                    <td class="text-center">
                        <a href="{{ route('visitor.edit', $visitor->id) }}" class="btn btn-warning btn-sm">Update</a>
                        <form action="{{ route('visitor.destroy', $visitor->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this visitor?');">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No visitors found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(function () {
      
      $('#visitortable').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script> 

@endsection
