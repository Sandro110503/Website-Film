<!-- Form Edit User -->
@extends('backend.v_layout.layout')

@section('title', 'Edit User')

@section('content')
<!-- contentAwal -->
 <div class="content-wrapper p-4">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form action="{{ route('backend.user.update', $edit->id) }}" method="post" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="card-body">
                            <h4 class="card-title">{{ $judul }}</h4>
                            <div class="row">
                                <!-- Informasi lainnya -->
                                <div class="col-md-8">
                                    <!-- Role -->
                                    <div class="form-group">
                                        <label>Hak Akses</label>
                                        <select name="role" class="form-control @error('role') is-invalid @enderror">
                                            <option value="" {{ old('role', $edit->role) == '' ? 'selected' : '' }}>- Pilih Hak Akses -</option>
                                            <option value="admin" {{ old('role', $edit->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                                            <option value="user" {{ old('role', $edit->role) == 'user' ? 'selected' : '' }}>User</option>
                                        </select>
                                        @error('role')
                                            <span class="invalid-feedback alert-danger" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!-- Nama -->
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text" name="nama" value="{{ old('nama', $edit->nama) }}" class="form-control @error('nama') is-invalid @enderror" placeholder="Masukkan Nama">
                                        @error('nama')
                                            <span class="invalid-feedback alert-danger" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Email -->
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" name="email" value="{{ old('email', $edit->email) }}" class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan Email">
                                        @error('email')
                                            <span class="invalid-feedback alert-danger" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!-- Password Baru -->
                                    <div class="form-group">
                                        <label>Password <small class="text-muted">(Kosongkan jika tidak ingin diubah)</small></label>
                                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan Password Baru (opsional)">
                                        @error('password')
                                            <span class="invalid-feedback alert-danger" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- Tombol -->
                        <div class="border-top">
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary">Update</button>
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
