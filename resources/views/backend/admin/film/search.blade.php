<!-- Halaman Pencarian Search Dan Tombol Genre -->
@extends('backend.admin.film.ui') 

@section('title', 'Search')

@section('content')
<div class="bg-[#020d1f] min-h-screen px-6 py-8 text-white">
    <!-- Search Bar -->
    <div class="flex items-center gap-3 bg-[#06132c] rounded-full px-4 py-2 w-full max-w-3xl mx-auto mb-8">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
            viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 103 10.5a7.5 7.5 0 0013.15 6.15z" />
        </svg>
        <form action="{{ route('film.search') }}" method="GET" class="flex-grow">
            <input type="text" name="query" placeholder="Cari berdasarkan Judul, Genre, Tahun Rilis"
                class="bg-transparent w-full focus:outline-none text-white placeholder-gray-400" />
        </form>
    </div>

    <!-- Tombol Genre -->
    <h2 class="text-lg font-semibold mt-8 mb-3">Cari genre menarik untuk kamu</h2>
    <div class="flex flex-wrap gap-2">
        @foreach (['Action', 'Adventure', 'Anime', 'Biography', 'Comedy', 'Documentary', 'Drama', 'Family', 'Fantasy', 'History', 'Horror', 'Musical', 'Mystery', 'Romance', 'Sci-Fi', 'Supernatural', 'Sport', 'Slice of Life', 'Superhero', 'Thriller'] as $genre)
            <a href="{{ route('film.search', ['genre' => $genre]) }}"
            class="bg-[#06132c] hover:bg-[#0b2040] text-white px-4 py-2 rounded-full text-sm">
            {{ $genre }}
            </a>
        @endforeach
    </div>
</div>
@endsection
