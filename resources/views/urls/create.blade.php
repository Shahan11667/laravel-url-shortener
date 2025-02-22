@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Shorten a URL</h3>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
                <br>
                <strong>Shortened URL:</strong> <a href="{{ session('short_url') }}" target="_blank">{{ session('short_url') }}</a>
            </div>
        @endif

        <form action="{{ route('shorten.url') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="original_url" class="form-label">Enter URL:</label>
                <input type="url" name="original_url" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="custom_slug" class="form-label">Custom Slug (Optional):</label>
                <input type="text" name="custom_slug" class="form-control">
            </div>

            <div class="mb-3">
                <label for="expires_at" class="form-label">Expiration Date (Optional):</label>
                <input type="date" name="expires_at" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Shorten URL</button>
        </form>
    </div>
</div>
@endsection
