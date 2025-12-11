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
                            <h5 class="mb-0">Edit Admin</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('layanan.update', $id->id_layanan) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label" for="kode">Kode Layanan</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('kode') is-invalid @enderror"
                                            id="kode" name="kode" value="{{ $id->kode}}">
                                        @error('kode')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label" for="nama_layanan">Nama Layanan</label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('nama_layanan') is-invalid @enderror"
                                            id="nama_layanan" name="nama_layanan" value="{{ $id->nama_layanan}}">
                                        @error('nama_layanan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label" for="harga_perkilo">Harga Perkilo</label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('harga_perkilo') is-invalid @enderror"
                                            id="harga_perkilo" name="harga_perkilo" value="{{ $id->harga_perkilo}}">
                                        @error('harga_perkilo')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label" for="estimasi">Estimasi</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('estimasi') is-invalid @enderror"
                                            id="estimasi" name="estimasi" value="{{ $id->estimasi }}">
                                        @error('estimasi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-lg btn-primary btn-lg  mt-4"
                                    style="margin: 50px 100px 25px 100px">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
