@extends('layout.main')
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

                            <a href="{{ route('laundry.create') }}" class="btn btn-success text-nowrap">
                                Export Excel
                            </a>

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
                                                            <i class="bx bx-loader-circle me-1 text-warning"></i> Sedang dalam proses
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
