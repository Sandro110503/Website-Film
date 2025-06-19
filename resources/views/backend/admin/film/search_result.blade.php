<!-- Halaman Hasil Pencarian Search Dan Tombol Genre -->
@extends('backend.admin.film.ui') 

@section('title', 'Result')

@section('content')

<div class="container mx-auto p-4 bg-[#020d1f] min-h-screen">
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
    <h2 class="text-lg text-white font-semibold mt-8 mb-3">Cari genre menarik untuk kamu</h2>
    <div class="flex flex-wrap gap-2">
        @foreach (['Action', 'Adventure', 'Anime', 'Biography', 'Comedy', 'Documentary', 'Drama', 'Family', 'Fantasy', 'History', 'Horror', 'Musical', 'Mystery', 'Romance', 'Sci-Fi', 'Supernatural', 'Sport', 'Slice of Life', 'Superhero', 'Thriller'] as $genre)
            <a href="{{ route('film.search', ['genre' => $genre]) }}"
            class="bg-[#06132c] hover:bg-[#0b2040] text-white px-4 py-2 rounded-full text-sm">
            {{ $genre }}
            </a>
        @endforeach
    </div>
    <h2 class="text-white text-xl font-semibold mb-4">Hasil Pencarian</h2>

    @if ($query)
        <p class="text-white mb-2">Pencarian berdasarkan: <strong>{{ $query }}</strong></p>
    @elseif ($selectedGenre)
        <p class="text-white mb-2">Genre: <strong>{{ $selectedGenre }}</strong></p>
    @endif
    
    @if ($films->count())
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4 mt-6">
            @foreach($films as $film)
                <div class="bg-[#06132c] rounded-lg overflow-hidden flex flex-col h-full">
                    <a href="{{ route('film.show', $film->id) }}" class="flex flex-col h-full">
                        <!-- Poster -->
                        <div class="aspect-[2/3] overflow-hidden">
                            <img class="w-full h-full object-cover" 
                                src="{{ asset('storage/' . $film->poster) }}" 
                                alt="{{ $film->title }}">
                        </div>

                        <!-- Info -->
                        <div class="p-2 flex flex-col justify-between flex-grow text-white">
                            <h3 class="text-sm font-semibold leading-tight mb-1"
                                style="max-height: 2.5rem; overflow: hidden; text-overflow: ellipsis;">
                                {{ $film->title }}
                            </h3>
                            <p class="text-xs text-gray-400 truncate">
                                {{ $film->genre }} • {{ $film->release_year }}
                            </p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-white mt-4">Tidak ada film ditemukan.</p>
    @endif
</div>
@endsection
