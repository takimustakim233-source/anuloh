<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - Perpustakaan Digital</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-indigo-100 via-purple-50 to-pink-100 min-h-screen flex items-center justify-center p-4 m-0">
    <!-- HANYA SATU CARD -->
    <div class="w-full max-w-5xl bg-white rounded-2xl shadow-2xl overflow-hidden flex flex-col md:flex-row">
        <!-- Kolom Kiri: Form Login -->
        <div class="w-full md:w-1/2 p-6 sm:p-8 lg:p-10">
            <div class="text-center mb-6">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-full shadow-lg mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">Masuk ke Perpustakaan</h1>
                <p class="text-gray-500 text-sm mt-1">Akses koleksi buku digital favoritmu</p>
            </div>

            @if (session('status'))
                <div class="mb-4 text-sm text-green-600 bg-green-100 rounded-lg p-2 text-center">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('email') border-red-500 @enderror"
                           placeholder="contoh@email.com">
                    @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kata Sandi</label>
                    <input type="password" name="password" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('password') border-red-500 @enderror"
                           placeholder="••••••••">
                    @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="flex items-center justify-between">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember" class="rounded border-gray-300 text-indigo-600">
                        <span class="ml-2 text-sm text-gray-600">Ingat saya</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-indigo-600 hover:underline">Lupa password?</a>
                    @endif
                </div>
                <button type="submit"
                        class="w-full bg-gradient-to-r from-indigo-600 to-blue-600 text-white py-2 rounded-lg font-semibold hover:from-indigo-700 hover:to-purple-700 transition shadow-md">
                    Login
                </button>
                @if (Route::has('register'))
                    <div class="text-center">
                        <p class="text-sm text-gray-600">Belum punya akun?
                            <a href="{{ route('register') }}" class="font-medium text-indigo-600 hover:underline">Daftar</a>
                        </p>
                    </div>
                @endif
            </form>
        </div>

        <!-- Kolom Kanan: Ilustrasi (hanya tampil di layar >= md) -->
        <div class="hidden md:flex md:w-1/2 bg-gradient-to-br from-indigo-600 to-blue-700 p-8 lg:p-10 text-white flex-col justify-between">
            <div class="text-center">
                <svg class="w-28 h-28 mx-auto opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
                <h2 class="text-xl font-bold mt-4">Perpustakaan Digital</h2>
                <p class="text-indigo-100 text-sm mt-1">Sekolah Modern</p>
            </div>
            <div class="space-y-2 mt-6">
                <div class="bg-white/10 rounded-lg p-2 text-sm">📚 Baca online/offline</div>
                <div class="bg-white/10 rounded-lg p-2 text-sm">✨ Update koleksi bulanan</div>
                <div class="bg-white/10 rounded-lg p-2 text-sm">🎓 Gratis anggota sekolah</div>
            </div>
            <p class="text-xs text-indigo-200 italic text-center mt-6">"Buku adalah jendela dunia"</p>
        </div>
    </div>
</body>
</html>