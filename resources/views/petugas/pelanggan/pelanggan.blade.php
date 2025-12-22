@extends('layout.main3')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="content-wrapper">
            <!-- Content -->
            <!-- Basic Bootstrap Table -->
            <div class="card">
                <h5 class="card-header">Pelanggan</h5>
                <div class="container-xxl flex-grow-1 container-p-y">
                    <div class="d-flex align-items-center gap-2" style="width: auto;">

                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalExport">
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

                                        <form action="{{ route('petugas.pelanggan.export') }}" method="GET">

                                            <div class="mb-3">
                                                <label class="form-label d-block text-center mb-2">Pilih Format File</label>

                                                <div class="btn-group w-100" role="group">
                                                    <input type="radio" class="btn-check" name="format" id="pdf"
                                                        value="pdf" checked>
                                                    <label class="btn btn-outline-danger" for="pdf">
                                                        <i class="bx bxs-file-pdf"></i> PDF
                                                    </label>

                                                    <input type="radio" class="btn-check" name="format" id="excel"
                                                        value="excel">
                                                    <label class="btn btn-outline-success" for="excel">
                                                        <i class="bx bxs-spreadsheet"></i> Excel
                                                    </label>
                                                </div>
                                            </div>

                                            <button type="submit" class="btn btn-primary w-100">Download</button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('petugas.pelanggan.create') }}" class="btn btn-primary text-nowrap">
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
                                <th>No Telp</th>
                                <th>Alamat</th>
                                <th>Tanggal</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($pelanggan as $p)
                                <tr>
                                    <td>
                                        <i class="text-danger me-4"></i>
                                        <span>{{ $loop->iteration }}</span>
                                    </td>
                                    <td>{{ $p->nama }}</td>
                                    <td>{{ $p->no_hp }}</td>
                                    <td>{{ $p->alamat }}</td>
                                    <td>{{ $p->created_at }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="icon-base bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item"
                                                    href="{{ route('pelanggan.edit', $p->id_pelanggan) }}"><i
                                                        class="icon-base bx bx-edit-alt me-1"></i> Edit</a>
                                                <form id="delete-form-{{ $p->id_pelanggan }}"
                                                    action="{{ route('pelanggan.delete', $p->id_pelanggan) }}"
                                                    method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <a class="dropdown-item" href="javascript:void(0);"
                                                    onclick="event.preventDefault(); 
                                                        if (confirm('Yakin ingin menghapus data ini?')) {
                                                            document.getElementById('delete-form-{{ $p->id_pelanggan }}').submit();}"><i
                                                        class="icon-base bx bx-trash me-1"></i> Delete</a>
                                            </div>
                                        </div>
                                    </td>
                            @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Tambahkan bagian dashboard lainnya --}}
        </div>
    @endsection
