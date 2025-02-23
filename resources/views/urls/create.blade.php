
@extends('layouts.app')

@section('content')


<div class="container text-center ">
    <h1 class="display-4 fw-bold text-gradient">🚀 Shorten Your Links in Seconds!</h1>
    <p class="lead text-muted mt-3">Fast, simple, and reliable URL shortener to make your links more manageable.</p>
    <img src="{{ asset('images/hero_image.jpg') }}" alt="URL Shortener" class="img-fluid hero-image my-4">
</div>


<div class="container text-center mt-5">
    <div class="row">
        <div class="col-md-4">
            <div class="feature-box">
                <img src="{{ asset('images/secure.png') }}" alt="Secure" class="feature-icon">
                <h4>🔒 Secure & Private</h4>
                <p>Your links are encrypted and safe from unauthorized access.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="feature-box">
                <img src="{{ asset('images/fast1.png') }}" alt="Fast" class="feature-icon">
                <h4>⚡ Lightning Fast</h4>
                <p>Generate a shortened link instantly with our optimized platform.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="feature-box">
                <img src="{{ asset('images/slug.webp') }}" alt="Custom Slug" class="feature-icon">
                <h4>🎯 Custom Slug</h4>
                <p>Personalize your links with a unique and memorable custom slug.</p>
            </div>
        </div>
    </div>
</div>

<div class=" d-flex justify-content-center align-items-center mt-5">
    <div class="row w-100 animated-card shadow-lg">

        <div class="col-md-6 d-flex align-items-center justify-content-center">
            <div class="card border-0 w-100">
                <div class="card-header bg-gradient text-white text-center">
                    <h3 class="mb-0 text-dark">🔗 Shorten a URL</h3>
                </div>
                <div class="card-body">

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show animated-alert" role="alert">
                            🎉 {{ session('success') }}
                            <br>
                            <strong>Shortened URL:</strong>
                            <a href="{{ session('short_url') }}" target="_blank" class="text-decoration-none fw-bold">
                                {{ session('short_url') }}
                            </a>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('shorten.url') }}" method="POST" class="animated-form">
                        @csrf
                        <div class="mb-3">
                            <label for="original_url" class="form-label fw-bold">🌐 Enter URL:</label>
                            <input type="url" name="original_url" class="form-control stylish-input"
                                   value="{{ old('original_url') }}" placeholder="https://example.com" required>
                        </div>

                        <div class="mb-3">
                            <label for="custom_slug" class="form-label fw-bold">🔠 Custom Slug (Optional):</label>
                            <input type="text" name="custom_slug" class="form-control stylish-input"
                                   value="{{ old('custom_slug') }}" placeholder="your-custom-slug">
                        </div>

                        <div class="mb-3">
                            <label for="expires_at" class="form-label fw-bold">📅 Expiration Date (Optional):</label>
                            <input type="date" name="expires_at" class="form-control stylish-input"
                                   value="{{ old('expires_at') }}" id="expires_at">
                        </div>

                        <button type="submit" class="btn btn-primary w-100 animated-btn">🚀 Shorten URL</button>
                    </form>
                </div>
            </div>
        </div>


        <div class="col-md-6 d-none d-md-block position-relative">
            <img src="{{ asset('images/url-shortener.avif') }}" alt="Shorten URL" class="img-fluid animated-image">
        </div>
    </div>
</div>


<script>
    document.getElementById("expires_at").min = new Date().toISOString().split("T")[0];
</script>


<style>

    .text-gradient {
        background: linear-gradient(45deg, #6a11cb, #2575fc);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .hero-image {
        max-width: 800px;
        animation: fadeIn 1s ease-in-out;
    }

    .feature-box {
        padding: 20px;
        border-radius: 10px;
        background: #f8f9fa;
        transition: all 0.3s ease-in-out;
        margin-bottom: 20px;
    }

    .feature-box:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    .feature-icon {
        width: 60px;
        height: 60px;
        margin-bottom: 10px;
    }


    .animated-card {
        /* max-width: 900px; */
        width: 100%;
        border-radius: 12px;
        overflow: hidden;
        animation: fadeIn 0.8s ease-in-out;
    }


    .bg-gradient {
        background: linear-gradient(45deg, #6a11cb, #2575fc);
        color: white;
        padding: 15px;
    }


    .stylish-input {
        border: 2px solid #6a11cb;
        border-radius: 8px;
        transition: all 0.3s ease-in-out;
        padding: 10px;
    }

    .stylish-input:focus {
        border-color: #2575fc;
        box-shadow: 0 0 10px rgba(37, 117, 252, 0.3);
    }

    /* Submit Button Animation */
    .animated-btn {
        background: linear-gradient(45deg, #ff416c, #ff4b2b);
        border: none;
        font-weight: bold;
        padding: 12px;
        transition: all 0.3s ease-in-out;
        border-radius: 8px;
    }

    .animated-btn:hover {
        transform: scale(1.05);
        background: linear-gradient(45deg, #ff4b2b, #ff416c);
    }

    /* Success Message Animation */
    .animated-alert {
        animation: slideIn 0.5s ease-in-out;
    }

    /* Right Side Image */
    .animated-image {
        width: 100%;
        height: 100%;
        /* object-fit: cover; */
        border-radius: 0 12px 12px 0;
        animation: zoomIn 1s ease-in-out;
    margin-left: 20px;
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
