<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Mobility Market - Platform jual beli mobil terpercaya">
    <title>Jual Beli Mobiwww | Platform Jual Beli Mobil</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/logo.jpg') }}" type="image/jpg">

    <!-- Bootstrap CSS & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

    <style>
        :root {
            --primary-color: #2563eb;
            --primary-dark: #1d4ed8;
            --primary-light: #3b82f6;
            --secondary-color: #1e293b;
            --secondary-light: #334155;
            --accent-color: #f59e0b;
            --light-gray: #f8fafc;
            --dark-gray: #64748b;
            --success-color: #10b981;
        }

        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            min-height: 100vh;
            display: flex;
            background-color: var(--light-gray);
            line-height: 1.6;
        }

        /* Left Section - Hero */
        .left {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: white;
            flex: 1;
            padding: 4rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .left::before {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
        }

        .left::after {
            content: '';
            position: absolute;
            bottom: -80px;
            left: -80px;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
        }

        .left-content {
            position: relative;
            z-index: 2;
            max-width: 600px;
        }

        .left h1 {
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 1.5rem;
            position: relative;
            display: inline-block;
        }

        .left h1::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 80px;
            height: 4px;
            background-color: var(--accent-color);
            border-radius: 2px;
        }

        .left p {
            font-size: 1.25rem;
            font-weight: 400;
            line-height: 1.6;
            opacity: 0.9;
            margin-bottom: 2rem;
        }

        .stats {
            display: flex;
            gap: 2rem;
            margin: 2rem 0;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: white;
            margin-bottom: 0.25rem;
        }

        .stat-label {
            font-size: 0.9rem;
            opacity: 0.8;
        }

        /* Right Section - Login */
        .right {
            flex: 1;
            background-color: #fff;
            padding: 4rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .card-custom {
            max-width: 480px;
            width: 100%;
            border: none;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            position: relative;
            z-index: 2;
            background: white;
        }

        .card-body {
            padding: 2.5rem;
        }

        /* Updated Logo Styles */
        .logo {
            margin-bottom: 2.5rem;
            text-align: center;
        }

        .logo img {
            height: auto;
            max-height: 100px;
            width: auto;
            max-width: 320px;
            transition: all 0.3s ease;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .logo:hover img {
            transform: scale(1.05);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
        }

        .btn-admin {
            background-color: var(--secondary-color);
            color: white;
            font-weight: 600;
            border-radius: 10px;
            padding: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            width: 100%;
            transition: all 0.3s ease;
            border: none;
            font-size: 1rem;
            position: relative;
            overflow: hidden;
        }

        .btn-admin::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: 0.5s;
        }

        .btn-admin:hover {
            background-color: var(--secondary-light);
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .btn-admin:hover::before {
            left: 100%;
        }

        .btn-admin:active {
            transform: translateY(0);
        }

        .cars-container {
            display: flex;
            gap: 1.5rem;
            margin-top: 2rem;
            width: 100%;
            justify-content: center;
        }

        .car-image {
            width: 45%;
            max-width: 300px;
            filter: drop-shadow(0 15px 20px rgba(0, 0, 0, 0.15));
            transition: transform 0.5s ease;
            border-radius: 12px;
        }

        .car-image:hover {
            transform: translateY(-5px);
        }

        .features {
            display: flex;
            gap: 1.5rem;
            margin-top: 2rem;
            flex-wrap: wrap;
        }

        .feature {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 1rem;
            background: rgba(255, 255, 255, 0.1);
            padding: 0.75rem 1rem;
            border-radius: 8px;
            backdrop-filter: blur(5px);
            transition: transform 0.3s ease;
        }

        .feature:hover {
            transform: translateY(-3px);
            background: rgba(255, 255, 255, 0.15);
        }

        .feature i {
            color: var(--accent-color);
            font-size: 1.2rem;
        }

        /* Decorations */
        .floating-circles {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1;
        }

        .circle {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.05);
        }

        .circle-1 {
            width: 150px;
            height: 150px;
            top: 10%;
            right: 5%;
            animation: float 8s infinite ease-in-out;
        }

        .circle-2 {
            width: 80px;
            height: 80px;
            bottom: 15%;
            right: 20%;
            animation: float 6s infinite ease-in-out 1s;
        }

        .circle-3 {
            width: 120px;
            height: 120px;
            bottom: 25%;
            left: 10%;
            animation: float 7s infinite ease-in-out 2s;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0) rotate(0deg);
            }
            50% {
                transform: translateY(-20px) rotate(5deg);
            }
        }

        /* Testimonials Section */
        .testimonials-container {
            display: flex;
            gap: 1.5rem;
            margin-top: 2rem;
            overflow-x: auto;
            padding-bottom: 1rem;
            scrollbar-width: thin;
        }

        .testimonial {
            background: rgba(255, 255, 255, 0.1);
            padding: 1.5rem;
            border-radius: 12px;
            min-width: 280px;
            flex-shrink: 0;
            position: relative;
        }

        .testimonial::before {
            content: '"';
            position: absolute;
            top: 10px;
            left: 15px;
            font-size: 4rem;
            color: rgba(255, 255, 255, 0.1);
            font-family: serif;
            line-height: 1;
        }

        .testimonial-content {
            position: relative;
            z-index: 2;
            font-style: italic;
            margin-bottom: 1rem;
        }

        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .author-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid white;
        }

        .author-info {
            display: flex;
            flex-direction: column;
        }

        .author-name {
            font-weight: 600;
        }

        .author-title {
            font-size: 0.8rem;
            opacity: 0.8;
        }

        /* Responsive Adjustments */
        @media (max-width: 1200px) {
            .left h1 {
                font-size: 3rem;
            }
            
            .left p {
                font-size: 1.1rem;
            }
            
            .stats {
                gap: 1.5rem;
            }
        }

        @media (max-width: 992px) {
            .left h1 {
                font-size: 2.75rem;
            }
            
            .stat-number {
                font-size: 1.75rem;
            }
            
            .car-image {
                max-width: 250px;
            }
            
            .logo img {
                max-height: 80px;
                max-width: 280px;
            }
        }

        @media (max-width: 768px) {
            body {
                flex-direction: column;
            }

            .left, .right {
                width: 100%;
                text-align: center;
                padding: 3rem 2rem;
            }

            .left h1::after {
                left: 50%;
                transform: translateX(-50%);
            }

            .left-content {
                max-width: 100%;
            }

            .features {
                justify-content: center;
            }

            .card-custom {
                max-width: 100%;
            }
            
            .stats {
                justify-content: center;
            }
            
            .cars-container {
                flex-direction: column;
                align-items: center;
            }
            
            .car-image {
                width: 80%;
                max-width: 300px;
                margin-bottom: 1rem;
            }
            
            .logo {
                margin-bottom: 1.5rem;
            }

            .testimonials-container {
                flex-direction: column;
                gap: 1rem;
            }
            
            .testimonial {
                min-width: 100%;
            }
        }

        @media (max-width: 576px) {
            .left h1 {
                font-size: 2.25rem;
            }
            
            .card-body {
                padding: 1.75rem;
            }
            
            .stats {
                flex-direction: column;
                gap: 1rem;
            }
            
            .feature {
                width: 100%;
                justify-content: center;
            }
            
            .logo img {
                max-height: 70px;
                max-width: 240px;
            }
        }
    </style>
</head>
<body>
    <!-- Left: Hero Section -->
    <div class="left">
        <div class="floating-circles">
            <div class="circle circle-1"></div>
            <div class="circle circle-2"></div>
            <div class="circle circle-3"></div>
        </div>
        
        <div class="left-content">
            <h1>Temukan Mobil Impian Anda</h1>
            <p>Platform terpercaya untuk jual beli mobil dengan proses mudah, aman, dan transparan. Dapatkan penawaran terbaik dari ribuan pilihan mobil berkualitas.</p>
            
            <div class="stats">
                <div class="stat-item">
                    <div class="stat-number">10K+</div>
                    <div class="stat-label">Mobil Tersedia</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">98%</div>
                    <div class="stat-label">Kepuasan Pelanggan</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">5K+</div>
                    <div class="stat-label">Transaksi Bulanan</div>
                </div>
            </div>
            
            <div class="features">
                <div class="feature">
                    <i class="bi bi-shield-check"></i>
                    <span>Proses 100% Aman</span>
                </div>
                <div class="feature">
                    <i class="bi bi-car-front"></i>
                    <span>Banyak Pilihan</span>
                </div>
                <div class="feature">
                    <i class="bi bi-currency-exchange"></i>
                    <span>Harga Kompetitif</span>
                </div>
            </div>
            
            <div class="testimonials-container">
                <div class="testimonial">
                    <div class="testimonial-content">
                        "Beli mobil pertama saya di Mobility Market sangat mudah dan aman. Prosesnya cepat dan harga lebih baik daripada dealer biasa."
                    </div>
                    <div class="testimonial-author">
                        <img src="{{ asset('images/testi1.jpg') }}" alt="Andi Budiman" class="author-avatar">
                        <div class="author-info">
                            <div class="author-name">Andi Budiman</div>
                            <div class="author-title">Pelanggan sejak 2024</div>
                        </div>
                    </div>
                </div>

                <div class="testimonial">
                    <div class="testimonial-content">
                        "Pelayanan sangat memuaskan! Saya berhasil menjual mobil lama dengan harga yang lebih tinggi dari perkiraan."
                    </div>
                    <div class="testimonial-author">
                        <img src="{{ asset('images/testi3.jpg') }}" alt="Budi Santoso" class="author-avatar">
                        <div class="author-info">
                            <div class="author-name">Budi Santoso</div>
                            <div class="author-title">Pelanggan sejak 2023</div>
                        </div>
                    </div>
                </div>

                <div class="testimonial">
                    <div class="testimonial-content">
                        "Transparansi harga dan proses yang sederhana membuat saya nyaman bertransaksi di sini. Sangat recommended!"
                    </div>
                    <div class="testimonial-author">
                        <img src="{{ asset('images/testi2.jpg') }}" alt="Citra Dewi" class="author-avatar">
                        <div class="author-info">
                            <div class="author-name">Citra Dewi</div>
                            <div class="author-title">Pelanggan sejak 2022</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="cars-container">
                <img src="{{ asset('images/eg1.png') }}" alt="Car Illustration 1" class="car-image">
                <img src="{{ asset('images/eg2.png') }}" alt="Car Illustration 2" class="car-image">
            </div>
        </div>
    </div>

    <!-- Right: Login Section -->
    <div class="right">
        <div class="card card-custom">
            <div class="card-body text-center">
                <div class="logo">
                    <img src="{{ asset('images/logo.jpg') }}" alt="Jual Beli Mobiwww Logo">
                </div>
                
                <h2 class="fw-bold text-dark mb-3">Selamat Datang</h2>
                <p class="text-muted mb-4">Silakan masuk untuk mengakses dashboard admin dan mulai mengelola platform.</p>

                @if (Route::has('filament.admin.auth.login'))
                    <div class="d-grid mt-4">
                        @auth
                            <a href="{{ route('filament.admin.pages.dashboard') }}" class="btn-admin">
                                <i class="bi bi-speedometer2"></i> Dashboard Admin
                            </a>
                        @else
                            <a href="{{ route('filament.admin.auth.login') }}" class="btn-admin">
                                <i class="bi bi-shield-lock-fill"></i> Masuk ke Admin
                            </a>
                        @endauth
                    </div>
                @endif
            </div>
        </div>
        
        <div class="mt-4 text-center">
            <p class="text-muted small">© 2021 Mobility Market. All rights reserved.</p>
        </div>
    </div>

    <script>
        document.addEventListener('keydown', function (e) {
            if (e.altKey && e.key.toLowerCase() === 'a') {
                const adminLink = document.querySelector('.btn-admin');
                if (adminLink) {
                    window.location.href = adminLink.href;
                }
            }
        });
        
        // Animate elements on scroll
        document.addEventListener('DOMContentLoaded', function() {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate__animated', 'animate__fadeInUp');
                    }
                });
            }, {
                threshold: 0.1
            });
            
            document.querySelectorAll('.left-content > *, .card-custom').forEach(el => {
                observer.observe(el);
            });
        });
    </script>
    
    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>