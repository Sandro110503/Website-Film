<!-- Halaman Memasukan Email Untuk Reset Password -->
<!DOCTYPE html>
<html>
<head>
    <title>Lupa Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-yellow-100">
    <div class="w-full max-w-md bg-white p-6 rounded-xl shadow-lg">
        <h2 class="text-xl font-bold mb-4 text-center">Lupa Password</h2>

        @if ($errors->any())
            <div class="text-red-600 mb-3">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('password.email') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="email" class="block font-medium">Email</label>
                <input type="email" name="email" placeholder="Masukkan Email" class="w-full px-4 py-2 border rounded-md" required>
            </div>

            <button class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600">
                Reset Password
            </button>
        </form>
    </div>
</body>
</html>
