 <!-- Form Edit Film -->
@extends('backend.v_layout.layout')

@section('title', 'Edit Film')

@section('content')
<div class="content-wrapper p-4">
    <h3>Edit Film</h3>

    <!-- Pesan Error -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif
    <!-- Form Edit Film -->
    <form action="{{ route('films.update', $film->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Judul Film</label>
            <input type="text" name="title" class="form-control" value="{{ $film->title }}" required>
        </div>

        <div class="form-group">
            <label>Genre</label>
            <input type="text" name="genre" class="form-control" value="{{ $film->genre }}" required>
        </div>

        <div class="form-group">
            <label>Tahun Rilis</label>
            <input type="number" name="release_year" class="form-control" value="{{ $film->release_year }}" required>
        </div>

        <div class="form-group">
            <label>Rating IMDb</label>
            <input type="text" name="rating_imdb" class="form-control" value="{{ $film->rating_imdb }}" required>
        </div>

        <div class="form-group">
            <label>Sinopsis</label>
            <textarea name="synopsis" class="form-control" rows="4" required>{{ $film->synopsis }}</textarea>
        </div>

        <div class="form-group">
            <label>Poster (opsional)</label>
            <input type="file" name="poster" class="form-control-file">
        </div>

        <button type="submit" class="btn btn-primary">Update Film</button>
        <a href="{{ route('backend.admin.film.index') }}">
            <button type="button" class="btn btn-secondary">Kembali</button>
        </a>
    </form>
</div>
@endsection
