@extends('layout.main3')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">

                        <h5 class="mb-0">Laundry</h5>

                        <div class="d-flex align-items-center gap-2">

                            <form action="{{ route('laundry') }}" method="GET" class="d-flex gap-2">
                                <input type="month" name="filter_bulan" class="form-control"
                                    value="{{ request('filter_bulan') }}" style="width: auto;">

                                <button type="submit" class="btn btn-secondary">
                                    <i class="icon-base bx bx-filter-alt"></i>
                                </button>

                                @if (request('filter_bulan'))
                                    <a href="{{ route('laundry') }}" class="btn btn-outline-secondary" title="Reset Filter">
                                        <i class="icon-base bx bx-x"></i>
                                    </a>
                                @endif
                            </form>

                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#modalExport">
                                <i class="bx bx-download me-1"></i> Export Laporan
                            </button>

                            <div class="modal fade" id="modalExport" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-sm" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Export Laporan</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">

                                            <ul class="nav nav-pills nav-fill mb-3" role="tablist">
                                                <li class="nav-item">
                                                    <button type="button" class="nav-link active" data-bs-toggle="tab"
                                                        data-bs-target="#tab-bulan">Bulanan</button>
                                                </li>
                                                <li class="nav-item">
                                                    <button type="button" class="nav-link" data-bs-toggle="tab"
                                                        data-bs-target="#tab-minggu">Mingguan</button>
                                                </li>
                                            </ul>

                                            <div class="tab-content">
                                                <div class="tab-pane fade show active" id="tab-bulan">
                                                    <form action="{{ route('laundry.export') }}" method="GET">
                                                        <input type="hidden" name="jenis" value="bulanan">

                                                        <div class="mb-3">
                                                            <label class="form-label">Pilih Bulan</label>
                                                            <input type="month" name="filter_bulan" class="form-control"
                                                                required>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label d-block">Format File</label>
                                                            <div class="btn-group w-100" role="group">
                                                                <input type="radio" class="btn-check" name="format"
                                                                    id="pdf1" value="pdf" checked>
                                                                <label class="btn btn-outline-danger" for="pdf1"><i
                                                                        class="bx bxs-file-pdf"></i> PDF</label>

                                                                <input type="radio" class="btn-check" name="format"
                                                                    id="xls1" value="excel">
                                                                <label class="btn btn-outline-success" for="xls1"><i
                                                                        class="bx bxs-spreadsheet"></i> Excel</label>
                                                            </div>
                                                        </div>

                                                        <button type="submit"
                                                            class="btn btn-primary w-100">Download</button>
                                                    </form>
                                                </div>

                                                <div class="tab-pane fade" id="tab-minggu">
                                                    <form action="{{ route('laundry.export') }}" method="GET">
                                                        <input type="hidden" name="jenis" value="mingguan">

                                                        <div class="mb-3">
                                                            <label class="form-label">Pilih Minggu</label>
                                                            <input type="week" name="filter_minggu" class="form-control"
                                                                required>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label d-block">Format File</label>
                                                            <div class="btn-group w-100" role="group">
                                                                <input type="radio" class="btn-check" name="format"
                                                                    id="pdf2" value="pdf" checked>
                                                                <label class="btn btn-outline-danger" for="pdf2"><i
                                                                        class="bx bxs-file-pdf"></i> PDF</label>

                                                                <input type="radio" class="btn-check" name="format"
                                                                    id="xls2" value="excel">
                                                                <label class="btn btn-outline-success" for="xls2"><i
                                                                        class="bx bxs-spreadsheet"></i> Excel</label>
                                                            </div>
                                                        </div>

                                                        <button type="submit"
                                                            class="btn btn-primary w-100">Download</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <a href="{{ route('laundry.create') }}" class="btn btn-primary text-nowrap">
                                Add Data
                            </a>

                        </div>
                    </div>

                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Layanan</th>
                                    <th>Resi</th>
                                    <th>Berat</th>
                                    <th>Total Harga</th>
                                    <th>Status</th>
                                    <th>Tanggal Masuk</th>
                                    <th>Tanggal Selesai</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($laundry as $ldr)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $ldr->pelanggan->nama ?? '_' }}</td>
                                        <td>{{ $ldr->layanan->nama_layanan ?? '_' }}</td>
                                        <td>{{ $ldr->resi ?? '_' }}</td>
                                        <td>{{ $ldr->berat }} Kg</td>
                                        <td>Rp{{ number_format($ldr->total_harga, 0, ',', '.') }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button"
                                                    class="btn btn-sm btn-outline-primary dropdown-toggle"
                                                    data-bs-toggle="dropdown">
                                                    {{ $ldr->status }}
                                                </button>

                                                <div class="dropdown-menu">

                                                    <form action="{{ route('laundry.updateStatus', $ldr->id_laundry) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status" value="Sedang dalam proses">
                                                        <button type="submit" class="dropdown-item">
                                                            <i class="bx bx-loader-circle me-1 text-warning"></i> Sedang
                                                            dalam proses
                                                        </button>
                                                    </form>

                                                    <form action="{{ route('laundry.updateStatus', $ldr->id_laundry) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status" value="Selesai">
                                                        <button type="submit" class="dropdown-item">
                                                            <i class="bx bx-check-circle me-1 text-success"></i> Selesai
                                                        </button>
                                                    </form>

                                                    <form action="{{ route('laundry.updateStatus', $ldr->id_laundry) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status" value="Diambil">
                                                        <button type="submit" class="dropdown-item">
                                                            <i class="bx bx-package me-1 text-primary"></i> Diambil
                                                        </button>
                                                    </form>

                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $ldr->tgl_masuk }}</td>
                                        <td>{{ $ldr->tgl_selesai }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                    <i class="icon-base bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item"
                                                        href="{{ route('laundry.cetak', $ldr->id_laundry) }}"
                                                        target="_blank">
                                                        <i class="icon-base bx bx-receipt me-1"></i> Cetak
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Tambahkan bagian dashboard lainnya --}}
            </div>
        </div>
    </div>
@endsection
