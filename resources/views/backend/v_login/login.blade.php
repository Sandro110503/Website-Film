<!-- Halaman Login -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex items-center justify-center min-h-screen bg-gradient-to-r from-indigo-200 via-red-200 to-yellow-100">
    <div class="w-full max-w-md p-8 bg-white rounded-xl shadow-lg">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">Login</h2>

        <!-- Pesan Error -->
        @if($errors->any())
            <div class="mb-4 text-sm text-red-600 bg-red-100 border border-red-300 p-3 rounded">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif


        <!-- Form Login -->
        <form action="{{ route('backend.login') }}" method="post" class="space-y-5">
            @csrf
            <div>
                <label for="email" class="block text-gray-700 font-semibold mb-1">Email</label>
                <input type="text" name="email" id="email" value="{{ old('email') }}"
                    class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-400 @error('email') border-red-500 @enderror"
                    placeholder="Masukkan Email">
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-gray-700 font-semibold mb-1">Password</label>
                <input type="password" name="password" id="password" value="{{ old('password') }}"
                    class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-400 @error('password') border-red-500 @enderror"
                    placeholder="Masukkan Password">
                @error('password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="text-center mt-3">
                <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:underline">
                    Lupa Password?
                </a>
            </div>
            <div>
                <button type="submit"
                    class="w-full bg-indigo-500 hover:bg-indigo-600 text-white font-semibold py-2 px-4 rounded-md transition duration-300">
                    Login
                </button>
            </div>
        </form>
        <!-- Tombol Register dan Login as Guest (sejajar) -->
        <div class="flex justify-between gap-2 mt-2">
            <a href="{{ route('backend.register') }}" 
                class="w-1/2 text-center bg-indigo-500 hover:bg-indigo-600 text-white font-semibold py-2 px-4 rounded-md transition duration-300">
                Register
            </a>
            <a href="{{ route('guest.login') }}"
                class="w-1/2 text-center bg-gray-300 hover:bg-gray-400 text-black font-semibold py-2 px-4 rounded-md transition duration-300">
                Login as Guest
            </a>
        </div>
    </div>
</body>

</html>
