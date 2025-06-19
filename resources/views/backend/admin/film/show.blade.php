<!-- Halaman Detail FIlm dan Ulasan Film -->
@extends('backend.admin.film.ui') 

@section('title', 'Detail Film')

@section('content')
<div class="container mx-auto px-4 py-8 bg-[#020d1f]">
    <div class="flex flex-col md:flex-row">
        <img src="{{ asset('storage/' . $film->poster) }}" alt="{{ $film->title }}" class="w-full md:w-1/3 rounded shadow">
        <div class="md:ml-6 mt-4 md:mt-0">
            <h1 class="text-3xl font-bold text-white">{{ $film->title }}</h1>
            <p class="mt-6 text-white">Rating IMDb: {{ $film->rating_imdb }}</p>
        @php
            $rating = $film->rating_imdb ?? 0; 
            $maxStars = 5;
            $stars = round($rating / 2, 1); 
            $fullStars = floor($stars);     
            $halfStar = ($stars - $fullStars) >= 0.5; 
            $emptyStars = $maxStars - $fullStars - ($halfStar ? 1 : 0);
        @endphp

        <p class="text-sm bg-gray-700 inline-block px-2 py-1 rounded mb-2">
            @for ($i = 0; $i < $fullStars; $i++)
                <span class="text-yellow-400">★</span>
            @endfor
            @if ($halfStar)
                <span class="text-yellow-400">☆</span>
            @endif
            @for ($i = 0; $i < $emptyStars; $i++)
                <span class="text-gray-500">★</span>
            @endfor
        </p>
        
            <p class="text-white">{{ $film->release_year }} - {{ $film->genre }}</p>
            <p class="mt-4 text-white">{{ $film->synopsis }}</p>
        </div>
    </div>

        {{-- Form Review --}}
    @if(Auth::check() && !session('guest'))
        {{-- Form untuk user login biasa --}}
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        <form method="POST" action="{{ route('review.store') }}" class="mt-4">
            @csrf
            <input type="hidden" name="film_id" value="{{ $film->id }}">
            {{-- Rating Bintang --}}
            <label for="rating" class="text-white block mb-2">Rating Anda:</label>
            <div class="rating flex flex-row-reverse justify-end mb-4 text-3xl">
                @for ($i = 5; $i >= 1; $i--)
                    <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i * 2 }}" class="hidden" />
                    <label for="star{{ $i }}" class="cursor-pointer text-gray-500 transition-colors">★</label>
                @endfor
            </div>

            {{-- Ulasan --}}
            <label for="review" class="text-white">Ulasan:</label><br>
            <textarea name="review" rows="4" cols="50" required class="block mb-4"></textarea><br>

            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                Kirim Ulasan
            </button>
        </form>
    @elseif(session('guest'))
        {{-- Notifikasi untuk Guest --}}
        <div class="mt-4 p-4 bg-yellow-200 text-yellow-800 rounded">
            Anda login sebagai <strong>Tamu</strong>. Untuk memberikan ulasan, silakan 
            <a href="{{ route('backend.login') }}" class="text-blue-600 underline hover:text-blue-800">login terlebih dahulu</a>.
        </div>
    @endif


    {{-- Menampilkan Ulasan --}}
    <h3 class="text-xl font-semibold text-white mt-8">Ulasan Pengguna</h3>
    @foreach($film->reviews as $review)
        <div class="text-white border-b border-gray-500 mb-4 pb-2">
            <strong>{{ $review->user->nama ?? 'Anonim' }}</strong><br>
            <strong>Rating: {{ $review->rating }}/10</strong><br>
            <p>{{ $review->review }}</p>
        </div>
    @endforeach
</div>
@endsection

