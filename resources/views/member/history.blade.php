<!DOCTYPE html>
<html lang="en" class="layout-menu-fixed layout-compact" data-assets-path="/assets/"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Cek Pesanan Laundry</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />
    <link href='https://cdn.boxicons.com/3.0.6/fonts/basic/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <style>
        /* 1. Background Full Layar */
        body {
            background-image: url('https://images.unsplash.com/photo-1545173168-9f1947eebb8f?q=80&w=2071&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            margin: 0;
            overflow: hidden;
            /* Supaya body tidak scroll, hanya konten list yang scroll */
        }

        /* 2. Overlay Gelap */
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            /* Agak lebih gelap biar kartu pop-up */
            z-index: 1;
        }

        /* 3. Container Utama */
        .main-container {
            position: relative;
            z-index: 2;
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-top: 20px;
        }

        /* 4. Area List Scrollable */
        .list-container {
            width: 100%;
            max-width: 800px;
            /* Lebar kartu maksimal */
            flex-grow: 1;
            overflow-y: auto;
            /* Scroll jika data banyak */
            padding: 0 15px 50px 15px;
            /* Padding bawah supaya footer tidak ketutup */
            scrollbar-width: none;
            /* Sembunyikan scrollbar (Firefox) */
        }

        .list-container::-webkit-scrollbar {
            display: none;
            /* Sembunyikan scrollbar (Chrome/Safari) */
        }

        /* 5. Styling Kartu ala "Robux" */
        .history-card {
            background: #fff;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
            border-left: 5px solid #696cff;
            /* Aksen warna di kiri */
        }

        .history-card:hover {
            transform: translateY(-2px);
            /* Efek naik dikit pas di hover */
        }

        /* Ikon Kotak */
        .service-icon {
            width: 70px;
            /* Sebelumnya 50px, diperbesar jadi 70px */
            height: 70px;
            /* Sebelumnya 50px, diperbesar jadi 70px */
            background-color: #e7e7ff;
            color: #696cff;
            border-radius: 12px;
            /* Radius sedikit disesuaikan */
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
            /* Ukuran ikon di dalamnya diperbesar dari 24px jadi 36px */
        }
    </style>
</head>

<body>

    <div class="overlay"></div>

    <div class="main-container">

        <div class="text-center mb-4">
            <h3 class="text-white fw-bold mb-1">Riwayat Pesanan</h3>
            <p class="text-white fw-bold mb-1">Daftar transaksi laundry terbaru Anda</p>
        </div>

        <div class="list-container">
            @forelse($laundry as $item)
                <div class="history-card d-flex align-items-center flex-wrap flex-sm-nowrap">
                    <div class="flex-shrink-0 me-3 mb-3 mb-sm-0">
                        <div class="service-icon">
                            <i class='bx  bx-dishwasher'></i>
                        </div>
                    </div>

                    <div class="flex-grow-1 me-3 mb-3 mb-sm-0">
                        <h5 class="fw-bold text-dark mb-1">{{ $item->layanan->nama_layanan ?? 'Layanan Laundry' }}</h5>
                        <div class="text-muted small mb-1">#{{ $item->resi }}</div>
                        <div class="d-flex align-items-center text-muted small">
                            <i class='bx bx-user me-1'></i> {{ $item->pelanggan->nama ?? 'Guest' }}
                        </div>
                    </div>

                    <div class="text-sm-end w-100 w-sm-auto">
                        @php
                            $badgeColor = match ($item->status_laundry) {
                                'Selesai' => 'bg-success',
                                'Sedang dalam proses' => 'bg-primary',
                                'Dibatalkan' => 'bg-danger',
                                'Diambil' => 'bg-info',
                                default => 'bg-secondary',
                            };
                        @endphp

                        <span class="badge {{ $badgeColor }} rounded-pill mb-2 px-3">
                            {{ $item->status_laundry }}
                        </span>

                        <div class="text-muted small mb-1">
                            Waktu Masuk: {{ date('d/m/Y - H:i', strtotime($item->tgl_masuk)) }}
                        </div>
                        <div class="fw-bold text-primary">
                            Total: Rp{{ number_format($item->total_harga, 0, ',', '.') }}
                        </div>
                        <a href="{{ route('laundry.cetak', $item->id_laundry) }}" target="_blank"
                            class="btn btn-primary text-nowrap">
                            Cetak Struk
                        </a>
                    </div>

                </div>
            @empty
                <div class="text-center text-white mt-5">
                    <i class='bx bx-ghost fs-1 mb-3'></i>
                    <p>Belum ada riwayat pesanan.</p>
                </div>
            @endforelse

        </div>

        <footer class="text-center pb-3">
            <div class="container text-white small">
                ©
                <script>
                    document.write(new Date().getFullYear())
                </script>, made with ❤️ by Laundry Berkah
            </div>
        </footer>

    </div>

    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
</body>

</html>
