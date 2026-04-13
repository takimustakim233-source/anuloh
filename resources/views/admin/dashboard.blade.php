<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-800">
            Dashboard Admin
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-6 space-y-6">

            {{-- WELCOME CARD --}}
            <div class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white p-6 rounded-2xl shadow-lg">
                <h3 class="text-2xl font-semibold">
                    Halo, {{ Auth::user()->name }} 👋
                </h3>
                <p class="mt-1 text-sm opacity-90">
                    Selamat datang di panel admin perpustakaan
                </p>
            </div>

            {{-- MENU CARD --}}
            <div class="grid md:grid-cols-3 gap-6">

                {{-- DATA BUKU --}}
                <a href="{{ route('books.index') }}"
                   class="bg-white p-6 rounded-2xl shadow hover:shadow-xl transition group">
                    <div class="text-blue-600 text-3xl mb-2">📚</div>
                    <h4 class="font-semibold text-lg text-slate-800 group-hover:text-blue-600">
                        Data Buku
                    </h4>
                    <p class="text-sm text-slate-500">
                        Kelola semua buku
                    </p>
                </a>

                {{-- DATA USER --}}
                <a href="{{ route('users.index') }}"
                   class="bg-white p-6 rounded-2xl shadow hover:shadow-xl transition group">
                    <div class="text-green-600 text-3xl mb-2">👤</div>
                    <h4 class="font-semibold text-lg text-slate-800 group-hover:text-green-600">
                        Data User
                    </h4>
                    <p class="text-sm text-slate-500">
                        Kelola anggota
                    </p>
                </a>

                {{-- DATA PEMINJAMAN --}}
                <a href="{{ route('borrowings.index') }}"
                   class="bg-white p-6 rounded-2xl shadow hover:shadow-xl transition group">
                    <div class="text-yellow-600 text-3xl mb-2">📦</div>
                    <h4 class="font-semibold text-lg text-slate-800 group-hover:text-yellow-600">
                        Peminjaman
                    </h4>
                    <p class="text-sm text-slate-500">
                        Verifikasi & kontrol
                    </p>
                </a>

            </div>

            {{-- QUICK INFO --}}
            <div class="grid md:grid-cols-3 gap-6">

                <div class="bg-white p-5 rounded-2xl shadow">
                    <p class="text-sm text-slate-500">Status</p>
                    <h3 class="text-lg font-semibold text-green-600">
                        Online
                    </h3>
                </div>

                <div class="bg-white p-5 rounded-2xl shadow">
                    <p class="text-sm text-slate-500">Role</p>
                    <h3 class="text-lg font-semibold text-blue-600">
                        Admin
                    </h3>
                </div>

                <div class="bg-white p-5 rounded-2xl shadow">
                    <p class="text-sm text-slate-500">Tanggal</p>
                    <h3 class="text-lg font-semibold text-slate-700">
                        {{ now()->format('d M Y') }}
                    </h3>
                </div>

            </div>

            {{-- LOGOUT --}}
            <div class="flex justify-end">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="px-5 py-2 bg-red-500 text-white rounded-xl shadow hover:bg-red-600 transition">
                        Logout
                    </button>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>