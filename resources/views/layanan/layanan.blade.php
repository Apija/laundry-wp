@extends('layout.main')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
                <!-- Basic Bootstrap Table -->
                <div class="card">
                    <h5 class="card-header">Layanan</h5>
                    <div class="table-responsive text-nowrap">
                        <a href="{{ route('layanan.create') }}" class="btn" style="margin-left: 850px">Add Data</a>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Layanan</th>
                                    <th>Nama Layanan</th>
                                    <th>Harga /kg</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($layanan as $l)
                                    <tr>
                                        <td>
                                            <i class="text-danger me-4"></i>
                                            <span>{{ $loop->iteration }}</span>
                                        </td>
                                        <td>{{ $l->kode }}</td>
                                        <td>{{ $l->nama_layanan }}</td>
                                        <td>{{ $l->harga_perkilo }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                    <i class="icon-base bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{ route('layanan.edit', $l->id_layanan) }}"><i
                                                            class="icon-base bx bx-edit-alt me-1"></i> Edit</a>
                                                     <form id="delete-form-{{ $l->id_layanan }}"
                                                        action="{{ route('layanan.delete', $l->id_layanan) }}"
                                                        method="POST" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                    <a class="dropdown-item" href=""
                                                        onclick="event.preventDefault(); 
                                                            if (confirm('Yakin ingin menghapus data ini?')) {
                                                                document.getElementById('delete-form-{{ $l->id_layanan }}').submit();}">
                                                        <i class="icon-base bx bx-trash me-1"></i> Delete</a>
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
