@extends('layout.main')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Add Laundry</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <form action="{{ route('laundry.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group" style="margin: 0px 100px 0px 100px">
                                    <label for="id_pelanggan">Nama Pelanngan :</label>
                                    <select class="form-control @error('id_pelanggan') is-invalid @enderror"
                                        id="id_pelanggan" name="id_pelanggan" value="{{ old('id_pelanggan') }}">
                                        <option>- Pilih Nama Pelanggan -</option>
                                        @foreach ($pelanggan as $p)
                                            <option value="{{ $p->id_pelanggan }}">{{ $p->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('pelanggan_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group" style="margin: 0px 100px 0px 100px">
                                    <label for="id_layanan">Nama Layanan :</label>
                                    <select class="form-control @error('id_layanan') is-invalid @enderror" id="id_layanan"
                                        name="id_layanan" value="{{ old('id_layanan') }}">
                                        <option>- Pilih Jenis Layanan -</option>
                                        @foreach ($layanan as $l)
                                            <option value="{{ $l->id_layanan }}" data-harga="{{ $l->harga_perkilo }}">
                                                {{ $l->nama_layanan }}</option>
                                        @endforeach
                                    </select>
                                    @error('layanan_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group" style="margin: 0px 100px 0px 100px">
                                    <label for="berat">Berat :</label>
                                    <input type="number" class="form-control @error('berat') is-invalid @enderror"
                                        id="berat" name="berat" value="{{ old('berat'), }}" oninput="updateHarga()">
                                    @error('berat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <input type="hidden" id="total_harga" name="total_harga">
                                <div class="form-group" style="margin: 0px 100px 0px 100px">
                                    <label for="status">Status :</label>
                                    <select class="form-control @error('status') is-invalid @enderror" id="status"
                                        name="status" value="{{ old('status') }}">
                                        <option value="Status">- Pilih Status -</option>
                                        <option value="Sedang dalam proses">Sedang dalam proses</option>
                                        <option value="Sudah selesai">Sudah Selesai</option>
                                        <option value="Dibatalkan">Dibatalkan</option>
                                    </select>
                                </div>
                                <div class="form-group" style="margin: 0px 100px 0px 100px">
                                    <label for="tgl_masuk">Tanggal Masuk :</label>
                                    <input type="date" class="form-control @error('tgl_masuk') is-invalid @enderror"
                                        id="tgl_masuk" name="tgl_masuk" value="{{ old('tgl_masuk') }}">
                                    @error('tgl_masuk')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group" style="margin: 0px 100px 0px 100px">
                                    <label for="tgl_selesai">Tanggal Selesai :</label>
                                    <input type="date" class="form-control @error('tgl_selesai') is-invalid @enderror"
                                        id="tgl_selesai" name="tgl_selesai" value="{{ old('tgl_selesai') }}">
                                    @error('tgl_selesai')
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
