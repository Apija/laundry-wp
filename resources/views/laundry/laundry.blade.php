@extends('layout.main')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <h5 style="margin: 0;">Laundry</h5>
                        
                        <div style="display: flex; gap: 10px;">
                            <a href="{{ route('laundry.create') }}" class="btn" style="white-space: nowrap;">Export Excel</a>
                            <a href="{{ route('laundry.create') }}" class="btn" style="white-space: nowrap;">Add Data</a>
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
                                        <td>
                                            <i class="text-danger me-4"></i>
                                            <span>{{ $loop->iteration }}</span>
                                        </td>
                                        <td>{{ $ldr->pelanggan->nama ?? '_' }}</td>
                                        <td>{{ $ldr->layanan->nama_layanan ?? '_' }}</td>
                                        <td>{{ $ldr->resi ?? '_' }}</td>
                                        <td>{{ $ldr->berat }} Kg</td>
                                        <td>Rp{{ number_format($ldr->total_harga, 0, ',', '.') }}</td>
                                        <td>{{ $ldr->status }}</td>
                                        <td>{{ $ldr->tgl_masuk }}</td>
                                        <td>{{ $ldr->tgl_selesai }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                    <i class="icon-base bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{ route('laundry.edit', $ldr->id_laundry) }}"><i
                                                            class="icon-base bx bx-edit-alt me-1"></i> Edit</a>
                                                    <a class="dropdown-item" href="{{ route('laundry.cetak', $ldr->id_laundry) }}"><i
                                                            class="icon-base bx bx-receipt"></i> Cetak</a>
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