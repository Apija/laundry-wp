<!DOCTYPE html>
<html lang="en" class="layout-menu-fixed layout-compact" data-assets-path="/assets/"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Cek Laundry</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/iconify-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <style>
        /* 1. Mengatur Background Gambar Full Layar */
        body {
            /* Ganti URL di bawah dengan gambar laundry kamu sendiri */
            /* Contoh: url("{{ asset('assets/img/backgrounds/laundry-bg.jpg') }}"); */
            background-image: url('https://images.unsplash.com/photo-1545173168-9f1947eebb8f?q=80&w=2071&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh; /* Tinggi full layar */
            margin: 0;
            overflow: hidden; /* Hilangkan scrollbar */
        }

        /* 2. Membuat Overlay Hitam Transparan (Supaya teks jelas) */
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Hitam transparansi 50% */
            z-index: 1;
        }

        /* 3. Wadah Utama di atas Overlay */
        .main-container {
            position: relative;
            z-index: 2; /* Di atas overlay */
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between; /* Header atas, Konten tengah, Footer bawah */
        }

        /* 4. Posisi Search Bar Tepat di Tengah */
        .center-content {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            align-items: center; /* Tengah horizontal */
            justify-content: center; /* Tengah vertikal */
            padding: 20px;
        }

        /* Style Kartu Pencarian */
        .search-card {
            width: 100%;
            max-width: 600px;
            background: rgba(255, 255, 255, 0.95); /* Putih agak transparan dikit */
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.3);
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="overlay"></div>

    <div class="main-container">
        
        <div class="pt-3 px-4">
            </div>

        <div class="center-content">
            
            <div class="search-card animate__animated animate__fadeInUp">
                <div class="mb-4">
                    <i class='bx bxs-washer bx-lg text-primary mb-2'></i>
                    <h3 class="fw-bold text-dark mb-1">Cek Status Laundry</h3>
                    <p class="text-muted">Masukkan nomor resi atau nama Anda untuk melacak pesanan</p>
                </div>

                <form action="#" method="GET"> <div class="input-group input-group-lg input-group-merge mb-3">
                        <span class="input-group-text bg-white border-end-0" id="basic-addon-search31">
                            <i class="bx bx-search text-muted"></i>
                        </span>
                        <input type="text" class="form-control border-start-0 ps-0" placeholder="Search" aria-label="Search..." required>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold shadow-sm">
                        Lacak Sekarang
                    </button>
                </form>
            </div>

        </div>

        <footer class="text-center pb-3">
            <div class="container text-white-50 small">
                © <script>document.write(new Date().getFullYear())</script>, made with ❤️ by Laundry Berkah
            </div>
        </footer>

    </div>

    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
</body>
</html>