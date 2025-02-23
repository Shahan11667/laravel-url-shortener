

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">
        <!-- Brand with Icon -->
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
            <img src="{{ asset('images/url.png') }}" alt="Logo" width="35" height="35" class="me-2">
            <span class="fw-bold">URL Shortener</span>
        </a>

        <!-- Navbar Toggler for Mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <!-- Home -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}">
                        <i class="fas fa-home"></i> Home
                    </a>
                </li>

                <!-- Previous URLs -->
                <li class="nav-item">
                    <a class="nav-link btn btn-primary px-3 text-white fw-bold" href="{{ route('shortened.previous') }}">
                        <i class="fas fa-link"></i> Previous URLs
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
