 <!-- Halaman Data Film -->
@extends('backend.v_layout.layout') 

@section('title', 'Data Film')

@section('content')
<div class="content-wrapper p-4">
    <!-- Form Search Database Film -->
    <form action="{{ route('films.index') }}" method="GET" class="mb-3 row g-2 align-items-end">
        <div class="col-md-4">
            <label for="search" class="form-label">Judul Film</label>
            <input type="text" name="query" class="form-control" placeholder="Cari Judul/Genre/Tahun Rilis">
        </div>
        
        <div class="col-md-3">
            <button type="submit" class="btn btn-primary w-100">Cari</button>
        </div>
    </form>

    <h3>Daftar Film</h3>

    <a href="{{ route('backend.admin.film.create') }}">
        <button type="button" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah
        </button>
    </a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Table Database Film -->
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Genre</th>
                <th>Tahun</th>
                <th>Rating IMDb</th>
                <th>Sinopsis</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($films as $film)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $film->title }}</td>
                <td>{{ $film->genre }}</td>
                <td>{{ $film->release_year }}</td>
                <td>{{ $film->rating_imdb }}</td>
                <td>{{ Str::limit($film->synopsis, 80) }}</td>
                <td>
                    <a href="{{ route('films.edit', $film->id) }}"> 
                        <button class="btn btn-primary btn-sm">
                            <i class="far fa-edit"></i> Ubah
                        </button>
                    </a>
                    <form action="{{ route('films.destroy', $film->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <p></p>
                        <button class="btn btn-danger show_confirm" data-konf-delete="{{ $film->title }}"><i class="fas fa-trash"></i> Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6">Belum ada data film.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
