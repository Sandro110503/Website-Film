<!-- Halaman Memasukkan Password Baru -->
<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-green-100">
    <div class="w-full max-w-md bg-white p-6 rounded-xl shadow-lg">
        <h2 class="text-xl font-bold mb-4 text-center">Reset Password</h2>

        @if ($errors->any())
            <div class="text-red-600 mb-3">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('password.update') }}" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" name="email" value="{{ $email }}">

            <div>
                <label for="password" class="block font-medium">Password Baru</label>
                <input type="password" name="password" placeholder="Masukkan Password Baru" class="w-full px-4 py-2 border rounded-md" required>
            </div>

            <div>
                <label for="password_confirmation" class="block font-medium">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" placeholder="Konfirmasi Password Baru" class="w-full px-4 py-2 border rounded-md" required>
            </div>

            <button class="w-full bg-indigo-500 text-white py-2 rounded-md hover:bg-indigo-600">
                Reset Password
            </button>
        </form>
    </div>
</body>
</html>
