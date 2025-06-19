<!-- Halaman Home -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>@yield('title', 'Home')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('dist/css/app.css') }}">
</head>
<body class="bg-white text-gray-900">

  <!-- Header -->
    <header class="text-gray-600 body-font bg-[#020d1f]">
        <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
            <a href="{{ route('backend.home') }}" class="flex title-font font-medium items-center text-white mb-4 md:mb-0">
                <span class="ml-3 text-xl">FavScreen</span>
            </a>
            <nav class="md:ml-auto flex flex-wrap items-center text-base justify-center">
                @auth
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('backend.dashboard') }}" class="mr-5 hover:text-blue-400 text-white">Dashboard</a>
                    @endif
                @endauth
                <a href="{{ route('backend.home') }}" class="mr-5 hover:text-blue-400 text-white">Home</a>
                <div class="relative inline-block">
                    <!-- Tombol utama -->
                    <button id="rekomendasiBtn" class="mr-5 hover:text-blue-400 text-white">
                        Recommended
                    </button>

                    <!-- Dropdown utama -->
                    <div id="rekomendasiDropdown" class="absolute z-20 mt-2 bg-white text-black rounded shadow-lg w-64 hidden">
                        <div class="py-2 px-4 space-y-4">
                            
                            <!-- Sub-dropdown Genre -->
                            <div class="relative group">
                                <button class=" w-full text-sm font-semibold text-gray-800">
                                    Genre ▼
                                </button>
                                <div class="absolute top-0 -left-40 bg-white border rounded shadow-lg w-[26rem] hidden group-hover:block z-40">
                                    <div class="p-2 grid grid-cols-4 gap-x-4 text-sm">
                                        @foreach ([
                                            'Action', 'Adventure', 'Anime', 'Biography', 'Comedy', 
                                            'Documentary', 'Drama', 'Family', 'Fantasy', 'History',
                                            'Horror', 'Musical', 'Mystery', 'Romance', 'Sci-Fi', 'Supernatural',
                                            'Sport', 'Slice of Life', 'Superhero', 'Thriller'
                                        ] as $genre)
                                            <a href="{{ route('film.filter', ['genre[]' => $genre]) }}" 
                                            class="hover:underline text-gray-700 flex justify-center items-center text-center">{{ $genre }}</a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <!-- Sub-dropdown Tahun Rilis -->
                            <div class="relative group">
                                <button class="w-full text-sm font-semibold text-gray-800">
                                    Tahun Rilis ▼
                                </button>
                                <div class="absolute top-0 -left-40 bg-white border rounded shadow-lg w-[26rem] hidden group-hover:block z-40">
                                    <div class="p-2 grid grid-cols-4 gap-x-4 text-sm">
                                        @for ($year = 2025; $year >= 2000; $year--)
                                            <a href="{{ route('film.filter', ['year' => $year]) }}"
                                            class="hover:underline text-gray-700 flex justify-center items-center text-center">{{ $year }}</a>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <a href="{{ route('blog.index') }}" class="mr-5 hover:text-blue-400 text-white">Blog</a>
                <!-- Form Search -->
                <a href="{{ route('film.search.form') }}" class="mr-5 hover:text-blue-400 text-white">
                    <i class="fas fa-search"></i>
                </a>
            </nav>
            @auth
             {{-- Logout untuk user login --}}
                <form method="POST" action="{{ route('backend.logout') }}">
                    @csrf
                    <button type="submit" class="inline-flex items-center bg-gray-900 border-0 py-1 px-3 
                                        focus:outline-none hover:bg-blue-400 rounded text-white text-base mt-4 md:mt-0">
                        Logout
                        <svg fill="none" stroke="currentColor" stroke-linecap="round" 
                            stroke-linejoin="round" stroke-width="2" 
                            class="w-4 h-4 ml-1" viewBox="0 0 24 24">
                        <path d="M5 12h14M12 5l7 7-7 7"></path>
                        </svg>
                    </button>
                </form>
            @elseif(session('guest'))
                {{-- Logout untuk tamu --}}
                <form method="POST" action="{{ route('backend.logout') }}">
                    @csrf
                    <button type="submit" class="inline-flex items-center bg-gray-900 border-0 py-1 px-3 
                                        focus:outline-none hover:bg-blue-400 rounded text-white rounded text-base mt-4 md:mt-0">Login
                        <svg fill="none" stroke="currentColor" stroke-linecap="round" 
                            stroke-linejoin="round" stroke-width="2" 
                            class="w-4 h-4 ml-1" viewBox="0 0 24 24">
                        <path d="M5 12h14M12 5l7 7-7 7"></path>
                        </svg>
                    </button>
                </form>
            @else
                {{-- Jika belum login sama sekali --}}
                <a href="{{ route('backend.login') }}" class="inline-block py-1 px-3 text-white hover:text-blue-400">Login</a>
            @endauth
        </div>
    </header>
    <!-- Slider -->
    <section class="w-full bg-gray-900 text-white py-12">
        <div class="swiper mySwiper w-full max-w-6xl mx-auto">
            <div class="swiper-wrapper">
                @if(isset($films))
                    @foreach ($sliderFilms as $film)
                        <div class="swiper-slide flex flex-col md:flex-row bg-gray-800 rounded-xl overflow-hidden shadow-lg">
                            <!-- Konten Teks -->
                            <div class="w-full md:w-1/2 p-6 flex flex-col justify-center-top">
                                <h2 class="text-3xl md:text-4xl font-semibold mb-2">{{ $film->title }}</h2>
                                @php
                                    $rating = $film->rating_imdb ?? 0;
                                    $maxStars = 5;
                                    $stars = round($rating / 2, 1); // dari 10 ke 5 bintang
                                    $fullStars = floor($stars);
                                    $halfStar = ($stars - $fullStars) >= 0.5;
                                    $emptyStars = $maxStars - $fullStars - ($halfStar ? 1 : 0);
                                @endphp
                                <p class="text-sm bg-gray-700 inline-flex items-center gap-1 px-3 py-1 rounded mb-2">
                                    {{ $film->genre }} • {{ $film->rating_imdb ?? '13+' }} •
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
                                <p class="text-gray-300 mb-4">{{ Str::limit($film->synopsis, 140) }}</p>
                                <a href="{{ route('film.show', $film->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded w-max">Lihat</a>
                            </div>
                            <!-- Poster -->
                            <div class="w-full md:w-1/2 aspect-[2/3] md:aspect-auto relative">
                                <a href="{{ route('film.show', $film->id) }}">
                                <img src="{{ asset('storage/' . $film->poster) }}" class="w-full h-[600px] object-contain bg-gray-800 p-4 rounded" />
                                </a>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
                <div class="swiper-pagination mt-4"></div>
        </div>
    </section>
    <!-- Section Trending -->
    <section class="text-white body-font bg-[#020d1f]">
        <div class="container px-5 py-8 mx-auto">
            <!-- Header Section -->
            <div class="flex flex-wrap w-full mb-10">
                <div class="lg:w-1/2 w-full mb-6 lg:mb-0">  
                    <h1 class="sm:text-3xl text-2xl font-semibold title-font mb-2 text-white">
                        Trending
                    </h1>
                    <div class="h-1 w-20 bg-indigo-500 rounded"></div>
                </div>
            </div>
            <!-- Cards Section -->
            <div class="relative film-slider-group">
                <!-- Tombol kiri -->
                <button class="scroll-left absolute left-0 top-1/2 -translate-y-1/2 bg-gray-800 bg-opacity-50 hover:bg-opacity-80 text-white p-2 rounded-full z-10">
                    &#8592;
                </button>
                <!-- Slider -->
                <div class="film-slider flex overflow-x-auto no-scrollbar snap-x snap-mandatory gap-4 px-4 py-6 scroll-smooth">
                    @foreach ($trendingFilms as $film)
                        <div class="snap-center flex-shrink-0 w-48">
                            <a href="{{ route('film.show', $film->id) }}" class="block rounded-xl overflow-hidden hover:opacity-90 transition duration-300">
                                <div class="aspect-[3/4] w-full rounded-xl overflow-hidden">
                                    <img class="w-full h-full object-cover" 
                                        src="{{ asset('storage/' . $film->poster) }}" 
                                        alt="{{ $film->title }}">
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
             <!-- Tombol kanan -->
                <button class="scroll-right absolute right-0 top-1/2 -translate-y-1/2 bg-gray-800 bg-opacity-50 hover:bg-opacity-80 text-white p-2 rounded-full z-10">
                    &#8594;
                </button>
            </div>
        </div>
    </section>
    <!-- Section Top Film -->
    <section class="text-white body-font bg-[#020d1f]">
        <div class="container px-5 py-8 mx-auto">
            <!-- Header Section -->
            <div class="flex flex-wrap w-full mb-10">
                <div class="lg:w-1/2 w-full mb-6 lg:mb-0">
                    <h1 class="sm:text-3xl text-2xl font-semibold title-font mb-2 text-white">
                        Top 10 Film
                    </h1>
                    <div class="h-1 w-20 bg-indigo-500 rounded"></div>
                </div>
            </div>
            <!-- Cards Section -->
            <div class="relative film-slider-group">
            <!-- Tombol kiri -->
                <button class="scroll-left absolute left-0 top-1/2 -translate-y-1/2 bg-gray-800 bg-opacity-50 hover:bg-opacity-80 text-white p-2 rounded-full z-10">
                    &#8592;
                </button>
                <!-- Slider -->
                <div class="film-slider flex overflow-x-auto no-scrollbar snap-x snap-mandatory gap-4 px-4 py-6 scroll-smooth">
                    @if(isset($films))
                        @foreach ($top10Films as $film)
                            <div class="snap-center flex-shrink-0 w-48">
                                <a href="{{ route('film.show', $film->id) }}" class="block rounded-xl overflow-hidden hover:opacity-90 transition duration-300">
                                    <div class="aspect-[3/4] w-full rounded-xl overflow-hidden">
                                        <img class="w-full h-full object-cover" 
                                            src="{{ asset('storage/' . $film->poster) }}" 
                                            alt="{{ $film->title }}">
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @endif
                </div>
                <!-- Tombol kanan -->
                <button class="scroll-right absolute right-0 top-1/2 -translate-y-1/2 bg-gray-800 bg-opacity-50 hover:bg-opacity-80 text-white p-2 rounded-full z-10">
                    &#8594;
                </button>
            </div>
        </div>
    </section>
    <!-- Section New Realese -->
    <section class="text-white body-font bg-[#020d1f]">
        <div class="container px-5 py-8 mx-auto">
            <!-- Header Section -->
            <div class="flex flex-wrap w-full mb-10">
                <div class="lg:w-1/2 w-full mb-6 lg:mb-0">
                    <h1 class="sm:text-3xl text-2xl font-semibold title-font mb-2 text-white">
                        New Release
                    </h1>
                    <div class="h-1 w-20 bg-indigo-500 rounded"></div>
                </div>
            </div>
            <!-- Cards Section -->
            <div class="relative film-slider-group">
                <!-- Tombol kiri -->
                <button class="scroll-left absolute left-0 top-1/2 -translate-y-1/2 bg-gray-800 bg-opacity-50 hover:bg-opacity-80 text-white p-2 rounded-full z-10">
                    &#8592;
                </button>
                <!-- Slider -->
                <div class="film-slider flex overflow-x-auto no-scrollbar snap-x snap-mandatory gap-4 px-4 py-6 scroll-smooth">
                    @if(isset($films))
                        @foreach ($newReleases as $film)
                            <div class="snap-center flex-shrink-0 w-48">
                                <a href="{{ route('film.show', $film->id) }}" class="block rounded-xl overflow-hidden hover:opacity-90 transition duration-300">
                                    <div class="aspect-[3/4] w-full rounded-xl overflow-hidden">
                                        <img class="w-full h-full object-cover" 
                                            src="{{ asset('storage/' . $film->poster) }}" 
                                            alt="{{ $film->title }}">
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @endif
                </div>
                <!-- Tombol kanan -->
                <button class="scroll-right absolute right-0 top-1/2 -translate-y-1/2 bg-gray-800 bg-opacity-50 hover:bg-opacity-80 text-white p-2 rounded-full z-10">
                    &#8594;
                </button>
            </div>
        </div>
    </section>

    @yield('content')

    <footer class="footer">
        <div class="footer-content">
            <div class="footer-left">
            <h1>FavScreen</h1>
            <h2>Universitas Bina Sarana Informatika</h2>
            </div>
            <div class="footer-right">
            <p>Contact Person: 0889-0577-4697</p>
            </div>
        </div>
        <div class="footer-bottom">
            © 2025 FavScreen. All rights reserved.
        </div>
    </footer>

<script src="{{ asset('dist/js/custom.js') }}"></script>
</body>
</html>
