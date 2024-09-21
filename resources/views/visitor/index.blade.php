@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>Daftar Pengunjung</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('visitor.create') }}" class="btn btn-primary mb-3">Tambah Pengunjung</a>
        <a href="{{ route('visitor.scan') }}" class="btn btn-success mb-3">Scan QR Code</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Affiliation</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($visitors as $visitor)
                    <tr>
                        <td>{{ $visitor->name }}</td>
                        <td>{{ $visitor->email }}</td>
                        <td>{{ $visitor->affiliation }}</td>
                        <td>
                            <a href="{{ route('visitor.show', $visitor->id) }}" class="btn btn-info btn-sm">Detail</a>
                            <a href="{{ route('visitor.undangan', $visitor->id) }}" class="btn btn-success btn-sm">Undangan</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">No visitors found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
