@extends('layout.main')
@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <!-- Basic Layout & Basic with Icons -->
            <div class="row mb-6 gy-6">
                <!-- Basic Layout -->
                <div class="col-xxl">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Tambah Layanan</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('layanan.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label" for="nama">Kode Layanan</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('kode') is-invalid @enderror"
                                            id="kode" name="kode" value="{{ old('kode') }}">
                                        @error('kode')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label" for="no_hp">Nama Layanan </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('nama_layanan') is-invalid @enderror"
                                            id="nama_layanan" name="nama_layanan" value="{{ old('nama_layanan') }}">
                                        @error('nama_layanan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label" for="no_hp">Harga Perkilo </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('harga_perkilo') is-invalid @enderror"
                                            id="harga_perkilo" name="harga_perkilo" value="{{ old('harga_perkilo') }}">
                                        @error('harga_perkilo')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row justify-content-end">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">Send</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endsection
