@extends('layout.main')
@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <!-- Basic Layout -->
            <div class="row mb-6 gy-6">
                <div class="col-xxl">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Edit Laundry</h5>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('laundry.update', $id->id_laundry) }}"
                                  method="POST"
                                  enctype="multipart/form-data">

                                @csrf
                                @method('PUT')

                                <!-- Nama Pelanggan -->
                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label" for="id_pelanggan">Nama Pelanggan :</label>
                                    <div class="col-sm-10">
                                        <select class="form-control @error('id_pelanggan') is-invalid @enderror"
                                                id="id_pelanggan" name="id_pelanggan">
                                            <option>- Pilih Nama Pelanggan -</option>
                                            @foreach ($pelanggan as $p)
                                                <option value="{{ $p->id_pelanggan }}"
                                                        @selected($p->id_pelanggan == $id->id_pelanggan)>
                                                    {{ $p->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('id_pelanggan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Nama Layanan -->
                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label" for="id_layanan">Nama Layanan :</label>
                                    <div class="col-sm-10">
                                        <select class="form-control @error('id_layanan') is-invalid @enderror"
                                                id="id_layanan" name="id_layanan">
                                            <option>- Pilih Jenis Layanan -</option>
                                            @foreach ($layanan as $l)
                                                <option value="{{ $l->id_layanan }}"
                                                        data-harga="{{ $l->harga_perkilo }}"
                                                        @selected($l->id_layanan == $id->id_layanan)>
                                                    {{ $l->nama_layanan }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('id_layanan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Berat -->
                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label" for="berat">Berat :</label>
                                    <div class="col-sm-10">
                                        <input type="number"
                                               class="form-control @error('berat') is-invalid @enderror"
                                               id="berat" name="berat"
                                               value="{{ old('berat', $id->berat) }}"
                                               oninput="updateHarga()">
                                        @error('berat')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <input type="hidden" id="total_harga" name="total_harga">

                                <!-- Status -->
                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label" for="status">Status :</label>
                                    <div class="col-sm-10">
                                        <select class="form-control @error('status') is-invalid @enderror"
                                                id="status" name="status">
                                            <option value="Status">- Pilih Status -</option>
                                            <option value="Sedang dalam proses" @selected($id->status == 'Sedang dalam proses')>
                                                Sedang dalam proses
                                            </option>
                                            <option value="Sudah selesai" @selected($id->status == 'Sudah selesai')>
                                                Sudah Selesai
                                            </option>
                                            <option value="Dibatalkan" @selected($id->status == 'Dibatalkan')>
                                                Dibatalkan
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Tanggal Masuk -->
                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label" for="tgl_masuk">Tanggal Masuk :</label>
                                    <div class="col-sm-10">
                                        <input type="date"
                                               class="form-control @error('tgl_masuk') is-invalid @enderror"
                                               id="tgl_masuk" name="tgl_masuk"
                                               value="{{ $id->tgl_masuk }}">
                                        @error('tgl_masuk')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Tanggal Selesai -->
                                <div class="row mb-6">
                                    <label class="col-sm-2 col-form-label" for="tgl_selesai">Tanggal Selesai :</label>
                                    <div class="col-sm-10">
                                        <input type="date"
                                               class="form-control @error('tgl_selesai') is-invalid @enderror"
                                               id="tgl_selesai" name="tgl_selesai"
                                               value="{{ $id->tgl_selesai }}">
                                        @error('tgl_selesai')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Button -->
                                <div class="row justify-content-end">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">Send</button>
                                    </div>
                                </div>

                            </form>
                        </div>

                    </div>
                </div>
            </div> <!-- /row -->
        </div> <!-- /container -->
    </div> <!-- /content-wrapper -->
@endsection
