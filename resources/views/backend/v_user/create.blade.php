<!-- Form Tambah User -->
@extends('Backend.v_Layout.layout')

@section('title', 'Tambah User')

@section('content')
<!-- contentAwal -->
  <div class="content-wrapper p-4">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form class="form-horizontal" action="{{ route('backend.user.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <h4 class="card-title"> {{ $judul }} </h4>

                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Hak Akses</label>
                                        <select name="role" class="form-control @error('role') is-invalid @enderror">
                                            <option value="" {{ old('role') == '' ? 'selected' : '' }}> - Pilih Hak Akses - </option>
                                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : 'admin' }}>Admin</option>
                                            <option value="user" {{ old('role') == 'user' ? 'selected' : 'user' }}>User</option>
                                        </select>
                                        @error('role')
                                            <span class="invalid-feedback alert-danger" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text" name="nama" value="{{ old('nama') }}" class="form-control @error('nama') is-invalid @enderror" placeholder="Masukkan Nama">
                                        @error('nama')
                                            <span class="invalid-feedback alert-danger" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan Email">
                                        @error('email')
                                            <span class="invalid-feedback alert-danger" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan Password">
                                        @error('password')
                                            <span class="invalid-feedback alert-danger" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Konfirmasi Password</label>
                                        <input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi Password">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="border-top">
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('backend.dashboard') }}">
                                    <button type="button" class="btn btn-secondary">Kembali</button>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- contentAkhir -->
@endsection
