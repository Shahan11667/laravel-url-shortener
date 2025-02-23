

@extends('layouts.app')

@section('content')

<div class="container text-center ">
    <h1 class="display-5 fw-bold text-gradient">🔗 Your Shortened URLs</h1>
    <p class="lead text-muted">Easily manage, track, and analyze your shortened links.</p>
    <img src="{{ asset('images/last.png') }}" alt="Shortened URLs" class="img-fluid hero-image my-4">
</div>


<div class="container my-4">
    <div class="input-group search-box shadow-sm">
        <span class="input-group-text bg-gradient text-white"><i class="fas fa-search"></i></span>
        <input type="text" id="slugSearch" class="form-control" placeholder="🔎 Search Shortened URLs..." onkeyup="filterSlugs()">
    </div>
</div>

<div class="container mt-4">
    @if(count($shortenedUrls) > 0)
        <div class="table-responsive animated-table">
            <table class="table table-bordered table-hover" id="urlTable">
                <thead class="table-dark">
                    <tr>
                        <th>🔗 Short URL</th>
                        <th>🌐 Original URL</th>
                        <th>⏳ Expires At</th>
                        <th>📊 Visit Count</th>
                        <th>⏰ Last Visited</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($shortenedUrls as $index => $url)
                        <tr class="url-row">
                            <td>
                                <div class="d-flex align-items-center">
                                    <input type="hidden" id="originalUrl-{{ $index }}" value="{{ $url['original_url'] }}">
                                    <input type="text" class="form-control text-center short-url" value="{{ $url['slug'] }}" readonly>
                                    <button class="btn btn-primary copy-btn" onclick="copyToClipboard('originalUrl-{{ $index }}', this)">
                                        <i class="fas fa-copy"></i>
                                    </button>
                                </div>
                                <a href="{{ route('shortened.redirect', ['slug' => $url['slug']]) }}" target="_blank" class="text-decoration-none text-primary mt-1 d-block">
                                    <strong>🔗 Open</strong>
                                </a>
                            </td>
                            <td>
                                <a  target="_blank" class="text-decoration-none">
                                    {{ Str::limit($url['original_url'], 50) }}
                                </a>
                            </td>
                            <td>{{ $url['expires_at'] ?? 'Never' }}</td>
                            <td>{{ $url['visit_count'] }}</td>
                            <td>{{ $url['last_visited'] ? \Carbon\Carbon::parse($url['last_visited'])->diffForHumans() : 'Never' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-info text-center mt-3 animated-alert">
            ⚠️ No URLs have been shortened yet.
        </div>
    @endif
</div>

<!-- JavaScript -->
<script>
    // Copy to Clipboard Function
    function copyToClipboard(inputId, btn) {
        var originalUrl = document.getElementById(inputId).value;
        navigator.clipboard.writeText(originalUrl)
            .then(() => {
                btn.innerHTML = '<i class="fas fa-check"></i>';
                setTimeout(() => { btn.innerHTML = '<i class="fas fa-copy"></i>'; }, 2000);
            })
            .catch(err => console.error("Failed to copy: ", err));
    }

    // Search & Filter Function
    function filterSlugs() {
        var searchValue = document.getElementById('slugSearch').value.toLowerCase();
        var rows = document.querySelectorAll('.url-row');

        rows.forEach(row => {
            var shortUrl = row.querySelector('.short-url').value.toLowerCase();
            row.style.display = shortUrl.includes(searchValue) ? "" : "none";
        });
    }
</script>

<!-- Custom Styles -->
<style>
    /* Gradient Text */
    .text-gradient {
        background: linear-gradient(45deg, #ff416c, #ff4b2b);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Search Bar */
    .search-box {
        max-width: 500px;
        margin: auto;
        border-radius: 50px;
        overflow: hidden;
    }

    .search-box .input-group-text {
        background: linear-gradient(45deg, #ff416c, #ff4b2b);
        color: white;
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

    /* Copy Button */
    .copy-btn {
        background-color: #ff416c;
        color: white;
        border: none;
        transition: all 0.3s ease-in-out;
    }

    .copy-btn:hover {
        background-color: #ff4b2b;
    }

    /* Hover Effects */
    .table-hover tbody tr:hover {
        background-color: rgba(255, 65, 108, 0.1);
    }

    /* Success Check Animation */
    .copy-btn i {
        transition: all 0.3s ease-in-out;
    }

    /* Alert Animation */
    .animated-alert {
        animation: slideIn 0.5s ease-in-out;
    }

    /* Animations */
    @keyframes slideIn {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

@endsection
