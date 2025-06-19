<!-- Dashboard -->
@extends('backend.v_layout.layout')

@section('title', 'Data User')

@section('content')
<div class="content-wrapper p-4">
    <h1 class="text-3xl font-bold text-gray-800 mb-4">Selamat datang, {{ Auth::user()->nama }}!</h1>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"> {{ $judul }} </h5>
                    <div class="table-responsive">
                        <a href="{{ route('backend.user.create') }}">
                            <button type="button" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Tambah
                            </button>
                        </a>
                        <table id="zero_config" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Email</th>
                                    <th>Nama</th>
                                    <th>Role</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($index as $row)
                                    <tr>
                                        <td> {{ $loop->iteration }} </td>
                                        <td> {{ $row->nama }} </td>
                                        <td> {{ $row->email }} </td>
                                        <td>
                                            @if ($row->role == 'admin')
                                                <span class="badge badge-success">Admin</span>
                                            @elseif ($row->role == 'user')
                                                <span class="badge badge-primary">User</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('backend.user.edit', $row->id) }}" title="Ubah Data">
                                                <button type="button" class="btn btn-primary btn-sm">
                                                    <i class="far fa-edit"></i> Ubah
                                                </button>
                                            </a>
                                            <form method="POST" 
                                                action="{{ route('backend.user.destroy', $row->id) }}"
                                                style="display: inline-block;">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" 
                                                        class="btn btn-danger btn-sm show_confirm" 
                                                        data-konf-delete="{{ $row->nama }}" 
                                                        title="Hapus Data">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

