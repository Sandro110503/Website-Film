 <!-- Form Tambah Film -->

@extends('backend.v_layout.layout')

@section('title', 'Tambah Film')

@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <h1>Tambah Film Baru</h1>
    </div>
  </section>

  <!-- Pesan Error -->
  <section class="content">
    <div class="container-fluid">
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
      @endif

      <!-- Form Input Film -->
      <form action="{{ route('films.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card card-primary">
          <div class="card-header"><h3 class="card-title">Form Film</h3></div>
          <div class="card-body">
            <div class="form-group">
              <label for="title">Judul Film</label>
              <input type="text" name="title" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="genre">Genre</label>
              <input type="text" name="genre" class="form-control" required>
            </div>
            <div class="mb-4">
              <label for="release_year" class="block text-sm font-medium text-gray-700">Tahun Rilis</label>
              <input type="number" name="release_year" id="release_year"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                    value="{{ old('release_year', $film->release_year ?? '') }}" required>
            </div>
            <div class="form-group">
              <label for="rating_imdb">Rating IMDb</label>
              <input type="number" name="rating_imdb" step="0.1" min="0" max="10" class="form-control" value="{{ old('rating_imdb') }}">
            </div>
            <div class="form-group">
              <label for="poster">Poster</label>
              <input type="file" name="poster" class="form-control-file">
            </div>

            <div class="form-group">
              <label for="synopsis">Sinopsis</label>
              <textarea name="synopsis" class="form-control" rows="4" required></textarea>
            </div>
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('backend.admin.film.index') }}">
                <button type="button" class="btn btn-secondary">Kembali</button>
            </a>
          </div>
        </div>
      </form>
    </div>
  </section>
</div>
@endsection
