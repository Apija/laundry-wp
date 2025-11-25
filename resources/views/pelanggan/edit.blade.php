@extends('layout.main')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Edit Members</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <form action="{{ route('pelanggan.update', $id->id_pelanggan) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group" style="margin: 0px 100px 0px 100px">
                                    <label for="nama">Nama :</label>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                        id="nama" name="nama" value="{{ $id->nama }}">
                                    @error('nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group" style="margin: 0px 100px 0px 100px">
                                    <label for="no_hp">Nomor Telepon :</label>
                                    <input type="text" class="form-control @error('no_hp') is-invalid @enderror"
                                        id="no_hp" name="no_hp" value="{{ $id->no_hp }}">
                                    @error('no_hp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group" style="margin: 0px 100px 0px 100px">
                                    <label for="alamat">Alamat :</label>
                                    <textarea class="form-control" id="alamat" name="alamat">{{ $id->alamat }}</textarea>
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
