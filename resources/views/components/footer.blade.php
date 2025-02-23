<footer class="footer bg-dark text-light text-center py-4 mt-3">
    <div class="container">
        <!-- Animated Icons -->
        <div class="social-icons mb-3">
            <a href="#" class="text-light mx-2"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="text-light mx-2"><i class="fab fa-twitter"></i></a>
            <a href="#" class="text-light mx-2"><i class="fab fa-instagram"></i></a>
            <a href="#" class="text-light mx-2"><i class="fab fa-linkedin"></i></a>
        </div>

        <!-- Footer Text -->
        <p class="mb-0">&copy; {{ date('Y') }} <span class="brand-name">URL Shortener</span>. All Rights Reserved.</p>
    </div>
</footer>

<!-- Footer Styling -->
<style>
    .footer {
        position: relative;
        overflow: hidden;
        background: linear-gradient(45deg, #1e1e1e, #292929);
        animation: footer-glow 4s infinite alternate;
    }

    /* Footer Text Animation */
    .brand-name {
        font-weight: bold;
        color: #FC68C0;
        animation: glow-text 1.5s ease-in-out infinite alternate;
    }

    /* Social Icons Animation */
    .social-icons a {
        font-size: 1.5rem;
        transition: transform 0.3s ease, color 0.3s ease;
    }

    .social-icons a:hover {
        transform: scale(1.2);
        color: #FC68C0;
    }

    /* Footer Glow Animation */
    @keyframes footer-glow {
        from {
            box-shadow: 0 0 10px #FC68C0;
        }
        to {
            box-shadow: 0 0 20px #FC68C0;
        }
    }

    /* Text Glow Animation */
    @keyframes glow-text {
        from {
            text-shadow: 0 0 5px #ffcc00, 0 0 10px #ff9900;
        }
        to {
            text-shadow: 0 0 10px #ff9900, 0 0 20px #ff6600;
        }
    }
</style>
