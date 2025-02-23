

@extends('layouts.app')

@section('content')


<div class="container text-center ">
    <h1 class="display-4 fw-bold text-gradient">🔗 Your Shortened URL is Ready!</h1>
    <p class="lead text-muted mt-3">Track analytics and monitor visitor engagement in real-time.</p>
    <img src="{{ asset('images/ana.png') }}" alt="URL Analytics" class="img-fluid hero-image my-4">
</div>


<div class="container d-flex justify-content-center align-items-center mt-4">
    <div class="row w-100 animated-card shadow-lg">
        <div class="col-md-6 d-flex align-items-center justify-content-center">
            <div class="card border-0 w-100">
                <div class="card-header bg-gradient text-white text-center">
                    <h3 class="mb-0 text-dark">🔗 Shortened URL Details</h3>
                </div>
                <div class="card-body">
                    <p><strong>🌐 Original URL:</strong>
                        <a  target="_blank" class="text-decoration-none text-primary">
                            {{ $shortUrl->original_url }}
                        </a>
                    </p>

                    <p><strong>🚀 Shortened URL:</strong>
                        <a href="{{ route('shortened.redirect', ['slug' => $shortUrl->slug]) }}" target="_blank"
                           class="text-decoration-none fw-bold text-white btn btn-primary w-25">
                            {{ $shortUrl->slug }}
                        </a>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-6 d-none d-md-block position-relative">
            <img src="{{ asset('images/analytics.png') }}" alt="Analytics Data" class="img-fluid animated-image">
        </div>
    </div>
</div>

<div class="container mt-5">
    <h4 class="text-center fw-bold">📊 Analytics Data</h4>

    @if($analytics->isNotEmpty())
        <div class="table-responsive animated-table">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>🔗 Referrer</th>
                        <th>📱 Device</th>
                        <th>⏳ Visited At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($analytics as $entry)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            {{-- <td >{{$entry->referrer ?? 'Direct' }}</td> --}}
                            <td>{{ Str::limit($entry->referrer ?? 'Direct', 30, '...') }}</td>

                            <td>{{ $entry->user_agent }}</td>
                            <td>{{ $entry->created_at->format('Y-m-d H:i:s') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-info text-center mt-3 animated-alert">
            ⚠️ No visits recorded yet.
        </div>
    @endif
</div>

<style>
    .text-gradient {
        background: linear-gradient(45deg, #ff416c, #ff4b2b);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .hero-image {
        max-width: 600px;
        animation: fadeIn 1s ease-in-out;
    }

    .animated-card {
        /* max-width: 900px; */
        width: 100%;
        border-radius: 12px;
        overflow: hidden;
        animation: fadeIn 0.8s ease-in-out;
    }

    .bg-gradient {
        background: linear-gradient(45deg, #ff416c, #ff4b2b);
        color: white;
        padding: 15px;
    }

    /* Table Styles */
    .animated-table {
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease-in-out;
    }

    .animated-table:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
    }

    /* Success Message Animation */
    .animated-alert {
        animation: slideIn 0.5s ease-in-out;
    }

    /* Right Side Image */
    .animated-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 0 12px 12px 0;
        animation: zoomIn 1s ease-in-out;
    }

    /* Animations */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes zoomIn {
        from {
            transform: scale(0.9);
            opacity: 0;
        }
        to {
            transform: scale(1);
            opacity: 1;
        }
    }
</style>

@endsection
