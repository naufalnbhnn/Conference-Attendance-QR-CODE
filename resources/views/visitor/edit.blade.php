@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Edit Visitor</h1>

    <form action="{{ route('visitor.update', $visitor->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $visitor->name }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $visitor->email }}" required>
        </div>

        <div class="mb-3">
            <label for="affiliation" class="form-label">Affiliation</label>
            <input type="text" class="form-control" id="affiliation" name="affiliation" value="{{ $visitor->affiliation }}" required>
        </div>

        <button type="submit" class="btn btn-success">Update Visitor</button>
        <a href="{{ route('visitor.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
