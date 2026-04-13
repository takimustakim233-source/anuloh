<x-app-layout>
    <x-slot name="header">
        Pinjaman Saya
    </x-slot>

    <div class="bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 min-h-screen px-4 sm:px-6 lg:px-8 py-8">

        {{-- TOMBOL PINJAM --}}
        <div class="mb-6">
            <a href="{{ route('borrowings.create') }}" 
               class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-xl hover:from-indigo-600 hover:to-purple-700 transition shadow-md">
                ➕ Pinjam Buku Baru
            </a>
        </div>

        {{-- NOTIF --}}
        @if(session('success'))
            <div class="mb-4 bg-green-100 text-green-700 p-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-4 bg-red-100 text-red-700 p-3 rounded">
                {{ $errors->first() }}
            </div>
        @endif

        {{-- LIST --}}
        @if($borrowings->count() > 0)
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">

            @foreach($borrowings as $b)
            <div class="bg-white rounded-xl shadow p-5 flex flex-col">

                <h3 class="font-bold text-lg mb-2">
                    {{ $b->book->title }}
                </h3>

                <p class="text-sm text-gray-500">
                    Pinjam: {{ \Carbon\Carbon::parse($b->borrowed_at)->format('d M Y') }}
                </p>

                <p class="text-sm text-gray-500">
                    Kembali: {{ \Carbon\Carbon::parse($b->return_date)->format('d M Y') }}
                </p>

                {{-- STATUS --}}
                <div class="mt-2 mb-3">
                    <span class="px-3 py-1 text-xs rounded-full
                        @if($b->status == 'pending') bg-gray-200
                        @elseif($b->status == 'dipinjam') bg-yellow-200
                        @elseif($b->status == 'kembali_req') bg-blue-200
                        @else bg-green-200
                        @endif">
                        {{ $b->status }}
                    </span>
                </div>

                {{-- AKSI --}}
                <div class="mt-auto space-y-2">

                    {{-- AJUKAN PENGEMBALIAN --}}
                    @if($b->status == 'dipinjam')
                    <form action="{{ route('borrowings.requestReturn', $b->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button class="w-full bg-yellow-500 text-white py-2 rounded hover:bg-yellow-600">
                            Ajukan Pengembalian
                        </button>
                    </form>
                    @endif

                    {{-- BATALKAN --}}
                    @if($b->status == 'pending')
                    <form action="{{ route('borrowings.destroy', $b->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Batalkan peminjaman?')" 
                            class="w-full bg-red-400 text-white py-2 rounded hover:bg-red-500">
                            Batalkan
                        </button>
                    </form>
                    @endif

                    {{-- INFO --}}
                    @if($b->status == 'kembali_req')
                        <div class="text-xs text-blue-600 text-center">
                            Menunggu verifikasi admin
                        </div>
                    @elseif($b->status == 'dikembalikan')
                        <div class="text-xs text-green-600 text-center">
                            ✔ Buku sudah dikembalikan
                        </div>
                    @endif

                </div>

            </div>
            @endforeach

        </div>
        @else

        {{-- EMPTY --}}
        <div class="text-center py-10">
            <h3 class="text-lg font-semibold">Belum ada pinjaman</h3>
            <p class="text-gray-500 text-sm mb-4">Yuk pinjam buku dulu</p>

            <a href="{{ route('borrowings.create') }}" 
               class="px-4 py-2 bg-indigo-500 text-white rounded">
                Pinjam Buku
            </a>
        </div>

        @endif

    </div>
</x-app-layout>