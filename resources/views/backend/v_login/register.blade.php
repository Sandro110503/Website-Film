<!-- Halaman Register -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-gradient-to-r from-green-200 to-blue-100">
    <div class="w-full max-w-md bg-white p-6 rounded-xl shadow-lg">
        <h2 class="text-2xl font-bold text-center mb-4">Register Akun</h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
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

        <form action="{{ route('backend.register.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="nama" class="block font-medium">Nama</label>
                <input type="text" name="nama" id="nama" value="{{ old('name') }}"
                    placeholder="Masukkan Nama" class="w-full px-4 py-2 border rounded-md" required>
            </div>

            <div>
                <label for="email" class="block font-medium">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}"
                    placeholder="Masukkan Email" class="w-full px-4 py-2 border rounded-md" required>
            </div>

            <div>
                <label for="password" class="block font-medium">Password</label>
                <input type="password" name="password" id="password"
                    placeholder="Masukkan Password" class="w-full px-4 py-2 border rounded-md" required>
            </div>

            <div>
                <label for="password_confirmation" class="block font-medium">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    placeholder="Konfirmasi Password" class="w-full px-4 py-2 border rounded-md" required>
            </div>

            <button type="submit" class="w-full bg-indigo-500 text-white font-semibold py-2 rounded-md hover:bg-indigo-600 transition">
                Register
            </button>
        </form>
    </div>
</body>
</html>
