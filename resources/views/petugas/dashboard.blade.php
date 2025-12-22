@extends('layout.main3')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        {{-- 1. HEADER WELCOME --}}
        <div class="card mb-4">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="text-primary mb-0">Welcome Petugas! 🎉</h4>
                    <p class="mb-0">Pantau performa bisnis laundry kamu hari ini.</p>
                </div>
            </div>
        </div>

        {{-- 2. KARTU STATISTIK (TOTAL NOMINAL) --}}
        <div class="row mb-4">
            <div class="col-lg-6 col-md-6 col-12 mb-4 mb-md-0">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div class="content-left">
                                <span>Pendapatan Bulan Ini</span>
                                <div class="d-flex align-items-end mt-2">
                                    <h3 class="mb-0 me-2 text-success">Rp {{ number_format($totalBulanIni, 0, ',', '.') }}</h3>
                                    <small class="text-success">(+{{ date('F') }})</small>
                                </div>
                                <small>Total pemasukan bersih bulan ini</small>
                            </div>
                            <div class="avatar">
                                <span class="avatar-initial rounded bg-label-success">
                                    <i class="bx bx-calendar-check bx-sm"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div class="content-left">
                                <span>Total Tahun {{ date('Y') }}</span>
                                <div class="d-flex align-items-end mt-2">
                                    <h3 class="mb-0 me-2 text-primary">Rp {{ number_format($totalTahunIni, 0, ',', '.') }}</h3>
                                    <small class="text-primary">(YTD)</small>
                                </div>
                                <small>Akumulasi pemasukan tahun ini</small>
                            </div>
                            <div class="avatar">
                                <span class="avatar-initial rounded bg-label-primary">
                                    <i class="bx bx-wallet bx-sm"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- 3. GRAFIK HARIAN (BULAN INI) --}}
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title m-0">📈 Grafik Harian ({{ date('F Y') }})</h5>
            </div>
            <div class="card-body">
                <canvas id="dailyChart" style="max-height: 200px;"></canvas>
            </div>
        </div>

        {{-- 4. GRAFIK TAHUNAN --}}
        <div class="card ">
            <div class="card-header">
                <h5 class="card-title m-0">📊 Grafik Bulanan ({{ date('Y') }})</h5>
            </div>
            <div class="card-body">
                <canvas id="monthlyChart" style="max-height: 200px;"></canvas>
            </div>
        </div>

    </div>

    {{-- Script Chart.js (Sama seperti sebelumnya) --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // CONFIG 1: GRAFIK HARIAN
        const ctxDaily = document.getElementById('dailyChart').getContext('2d');
        new Chart(ctxDaily, {
            type: 'line',
            data: {
                labels: @json($labelsHarian),
                datasets: [{
                    label: 'Pendapatan',
                    data: @json($dataHarian),
                    borderColor: '#71dd37', // Warna Hijau Success
                    backgroundColor: 'rgba(113, 221, 55, 0.2)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: { y: { beginAtZero: true } }
            }
        });

        // CONFIG 2: GRAFIK BULANAN
        const ctxMonthly = document.getElementById('monthlyChart').getContext('2d');
        new Chart(ctxMonthly, {
            type: 'bar',
            data: {
                labels: @json($labelsBulanan),
                datasets: [{
                    label: 'Pendapatan',
                    data: @json($dataBulanan),
                    backgroundColor: '#696cff', // Warna Ungu Primary
                    borderRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: { y: { beginAtZero: true } }
            }
        });
    </script>
@endsection