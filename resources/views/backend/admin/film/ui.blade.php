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
                {{-- Tamu: Arahkan ke halaman login user --}}
                <a href="{{ route('backend.login') }}" class="inline-flex items-center bg-gray-900 border-0 py-1 px-3 
                                        focus:outline-none hover:bg-blue-400 rounded text-white text-base mt-4 md:mt-0">
                    Login
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" 
                        stroke-linejoin="round" stroke-width="2" 
                        class="w-4 h-4 ml-1" viewBox="0 0 24 24">
                        <path d="M5 12h14M12 5l7 7-7 7"></path>
                    </svg>
                </a>

            @else
                {{-- Jika belum login sama sekali --}}
                <a href="{{ route('backend.login') }}" class="inline-block py-1 px-3 text-white hover:text-blue-400">Login</a>
            @endauth
        </div>
    </header>

    @section('content')

    @show

    <footer style="background-color: #0b1c2c; color: white; padding: 30px 50px;">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;">
            <div style="flex: 1;">
                <h3 style="margin: 0;">FavScreen</h3>
                <h2 style="margin: 0;">Universitas Bina Sarana Informatika</h2>
            </div>
            <div style="flex: 1; text-align: right;">
                <p style="margin: 0;">Contact Person: 0889-0577-4697</p>
            </div>
        </div>
        <div style="text-align: center; margin-top: 20px; font-size: 0.9em; color: #ccc;">
            © 2025 FavScreen. All rights reserved.
        </div>
    </footer>
    <script src="{{ asset('dist/js/custom.js') }}"></script>
</body>

