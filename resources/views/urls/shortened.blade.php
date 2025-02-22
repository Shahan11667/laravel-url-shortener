@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            Shortened URL
        </div>
        <div class="card-body text-center">
            <h5 class="card-title">Your Shortened URL:</h5>
            <a href="{{ route('shortened.redirect', ['slug' => $shortUrl->slug]) }}"
               target="_blank"
               class="btn btn-primary">
               {{ $shortUrl->slug }}
            </a>
        </div>
    </div>
</div>
@endsection
