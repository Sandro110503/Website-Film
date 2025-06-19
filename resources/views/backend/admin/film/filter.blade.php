 <!-- Halaman Filter Genre dan Tahun Rilis Film -->
@extends('backend.admin.film.ui')

@section('title', 'Recommended')

@section('content')
<!-- Menampilkan Filter Film Berdadsarkan Genre Dan Tahun Rilis -->
<div class="bg-[#020d1f] min-h-screen">
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold text-white mb-4">
            @if(!empty($genre))
                Genre: 
                @foreach((array)$genre as $g)
                    <span class="capitalize">{{ $g }}</span>{{ !$loop->last ? ',' : '' }}
                @endforeach
            @endif
            @if(isset($year))
                Tahun: {{ $year }}
            @endif
        </h1>

        @if($films->isEmpty())
            <p class="text-gray-400">Tidak ada film yang sesuai dengan filter.</p>
        @else
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4">
                @foreach($films as $film)
                    <div class="bg-[#06132c] rounded-xl overflow-hidden">
                        <a href="{{ route('film.show', $film->id) }}" class="block">
                            <div class="aspect-[2/3]">
                                <img class="w-full h-full object-cover rounded-xl" 
                                     src="{{ asset('storage/' . $film->poster) }}" 
                                     alt="{{ $film->title }}">
                            </div>
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
        @endif
    </div>
</div>
@endsection
