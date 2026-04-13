<x-app-layout>
    <x-slot name="header">
        PINJAM BUKU
    </x-slot>

    <div class="max-w-2xl mx-auto bg-white rounded-2xl shadow-lg overflow-hidden">
        <!-- Header form (opsional, biarkan sederhana) -->
        <div class="bg-gradient-to-r from-indigo-50 to-purple-50 px-6 py-4 border-b border-gray-100">
            <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
                Form Peminjaman Buku
            </h2>
            <p class="text-xs text-gray-500 mt-1">Isi data dengan benar ya!</p>
        </div>

        <!-- Form -->
        <div class="p-6">
            @if($errors->any())
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-lg">
                    <div class="font-medium mb-1">⚠️ Terjadi kesalahan:</div>
                    <ul class="list-disc ml-5 text-sm space-y-1">
                        @foreach($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('borrowings.store') }}" class="space-y-5">
                @csrf

                <!-- Pilih Buku -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">📖 Pilih Buku</label>
                    <select name="book_id" class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                        @foreach($books as $book)
                            <option value="{{ $book->id }}" {{ old('book_id') == $book->id ? 'selected' : '' }}>
                                {{ $book->title }} (Stok: {{ $book->stock }})
                            </option>
                        @endforeach
                    </select>
                    <p class="text-xs text-gray-400 mt-1">Pilih buku yang ingin dipinjam</p>
                </div>

                <!-- Tanggal Pinjam -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">📅 Tanggal Pinjam</label>
                    <input type="date" name="borrowed_at" value="{{ old('borrowed_at') }}"
                           class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                    <p class="text-xs text-gray-400 mt-1">Format: YYYY-MM-DD</p>
                </div>

                <!-- Tanggal Kembali -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">📅 Tanggal Kembali</label>
                    <input type="date" name="return_date" value="{{ old('return_date') }}"
                           class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                    <p class="text-xs text-gray-400 mt-1">Estimasi tanggal pengembalian</p>
                </div>

                <!-- Tombol Aksi -->
                <div class="flex flex-col sm:flex-row justify-between items-center gap-3 pt-4">
                    <a href="{{ route('borrowings.index') }}" 
                       class="inline-flex items-center gap-1 text-gray-500 hover:text-gray-700 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali
                    </a>

                    <button type="submit" 
                            class="inline-flex items-center gap-2 px-6 py-2.5 bg-gradient-to-r from-indigo-600 to-blue-600 text-white rounded-xl hover:from-indigo-700 hover:to-purple-700 transition shadow-md">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Pinjam Buku
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>