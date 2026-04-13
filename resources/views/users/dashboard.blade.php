<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-800">
            Dashboard
        </h2>
    </x-slot>

    <div class="space-y-8">

        {{-- 🔥 STATS --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <div class="bg-white p-6 rounded-2xl shadow border flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-400">Sedang Dipinjam</p>
                    <h3 class="text-3xl font-bold text-yellow-600">
                        {{ $dipinjam }}
                    </h3>
                </div>
                <div class="text-4xl">📚</div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow border flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-400">Menunggu Verifikasi</p>
                    <h3 class="text-3xl font-bold text-blue-600">
                        {{ $pending }}
                    </h3>
                </div>
                <div class="text-4xl">⏳</div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow border flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-400">Sudah Dikembalikan</p>
                    <h3 class="text-3xl font-bold text-green-600">
                        {{ $selesai }}
                    </h3>
                </div>
                <div class="text-4xl">✅</div>
            </div>

        </div>

        {{-- 🔥 WELCOME --}}
        <div class="bg-gradient-to-br from-purple-600 to-indigo-700 rounded-3xl p-8 text-white shadow-xl">
            
            @php
                $quotes = [
                    "Jangan lupa balikin buku ya 😏",
                    "Buku bagus itu yang dibaca 😎",
                    "Telat = denda 😈",
                    "Admin lagi ngawasin 👀",
                ];
            @endphp

            <div>
                <h3 class="text-2xl font-bold">
                    Halo, {{ Auth::user()->name }} 👋
                </h3>

                <p class="mt-2 text-blue-100">
                    {{ $quotes[array_rand($quotes)] }}
                </p>

                <p class="mt-2 text-sm text-blue-200">
                    @if(now()->hour < 12)
                        🌅 Semangat pagi!
                    @elseif(now()->hour < 18)
                        🌞 Jangan lupa istirahat
                    @else
                        🌙 Jangan begadang 😴
                    @endif
                </p>

                <a href="{{ route('borrowings.create') }}"
                   class="inline-block mt-6 px-6 py-3 bg-white text-blue-600 rounded-xl font-bold hover:bg-blue-50 transition">
                    Pinjam Buku
                </a>
            </div>
        </div>

        {{-- 🔥 LIST --}}
        <div class="bg-white p-6 rounded-2xl shadow">
            <h3 class="font-semibold text-lg mb-4">
                Peminjaman Terakhir
            </h3>

            @forelse($latest as $b)
                <div class="flex justify-between items-center border-b py-3">
                    <div>
                        <p class="font-semibold">{{ $b->book->title }}</p>
                        <p class="text-sm text-slate-500">
                            {{ $b->borrowed_at }} - {{ $b->return_date }}
                        </p>
                    </div>

                    <span class="text-xs px-3 py-1 rounded-full
                        {{ $b->status == 'pending' ? 'bg-blue-100 text-blue-600' : '' }}
                        {{ $b->status == 'dipinjam' ? 'bg-yellow-100 text-yellow-600' : '' }}
                        {{ $b->status == 'dikembalikan' ? 'bg-green-100 text-green-600' : '' }}">
                        {{ $b->status }}
                    </span>
                </div>
            @empty
                <p class="text-slate-500 text-sm">
                    Belum ada peminjaman
                </p>
            @endforelse
        </div>

    </div>

</x-app-layout>
