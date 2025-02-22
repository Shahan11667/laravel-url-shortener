@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Shortened URLs</h3>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Original URL</th>
                    <th>Short URL</th>
                    <th>Visits</th>
                    <th>Expires At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($urls as $url)
                    <tr>
                        <td><a href="{{ $url->original_url }}" target="_blank">{{ $url->original_url }}</a></td>
                        <td><a href="{{ url('/s/' . $url->slug) }}" target="_blank">{{ url('/s/' . $url->slug) }}</a></td>
                        <td>{{ $url->visits }}</td>
                        <td>{{ $url->expires_at ? $url->expires_at->format('Y-m-d') : 'Never' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
