@extends('layout.main')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
                <!-- Basic Bootstrap Table -->
                <div class="card">
                    <h5 class="card-header">Pelanggan</h5>
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>No Telp</th>
                                    <th>Alamat</th>
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
