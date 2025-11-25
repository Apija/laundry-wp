@extends('layout.main')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Add Servis</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <form action="{{ route('layanan.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group" style="margin: 0px 100px 0px 100px">
                                    <label for="kode">Kode Layanan :</label>
                                    <input type="text" class="form-control @error('kode') is-invalid @enderror"
                                        id="kode" name="kode" value="{{ old('kode') }}">
                                    @error('kode')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group" style="margin: 0px 100px 0px 100px">
                                    <label for="nama_layanan">Nama Layanan :</label>
                                    <input type="text" class="form-control @error('nama_layanan') is-invalid @enderror"
                                        id="nama_layanan" name="nama_layanan" value="{{ old('nama_layanan') }}">
                                    @error('nama_layanan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group"style="margin: 0px 100px 0px 100px">
                                    <label for="harga_perkilo">Harga Perkilo :</label>
                                    <input type="text" class="form-control @error('harga_perkilo') is-invalid @enderror"
                                        id="harga_perkilo" name="harga_perkilo" value="{{ old('harga_perkilo') }}">
                                    @error('harga_perkilo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
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
