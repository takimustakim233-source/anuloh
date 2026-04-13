<x-app-layout>
    <x-slot name="header">
        TAMBAH BUKU
    </x-slot>

    <div class="bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 min-h-screen px-4 sm:px-6 lg:px-8 py-8">
        <div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-lg overflow-hidden">
            <!-- Header form -->
            <div class="bg-gradient-to-r from-indigo-500 to-purple-600 px-6 py-4">
                <h2 class="text-white font-semibold text-lg flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                    Form Tambah Buku Baru
                </h2>
                <p class="text-indigo-100 text-xs mt-1">Isi data buku dengan lengkap dan benar</p>
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

                <form method="POST" action="{{ route('books.store') }}" class="space-y-5">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <!-- Judul -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">📖 Judul Buku</label>
                            <input type="text" name="title" value="{{ old('title') }}" required
                                   class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                        </div>

                        <!-- Author -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">✍️ Penulis</label>
                            <input type="text" name="author" value="{{ old('author') }}" required
                                   class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                        </div>

                        <!-- Publisher -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">🏢 Penerbit</label>
                            <input type="text" name="publisher" value="{{ old('publisher') }}"
                                   class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                        </div>

                        <!-- Tahun -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">📅 Tahun Terbit</label>
                            <input type="text" name="publication_year" value="{{ old('publication_year') }}"
                                   class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                        </div>

                        <!-- ISBN -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">🔢 ISBN</label>
                            <input type="text" name="isbn" value="{{ old('isbn') }}"
                                   class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                        </div>

                        <!-- Stock -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">📦 Stok Buku</label>
                            <input type="number" name="stock" value="{{ old('stock') }}" required
                                   class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                        </div>

                        <!-- Deskripsi -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">📝 Deskripsi</label>
                            <textarea name="description" rows="4"
                                      class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">{{ old('description') }}</textarea>
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex flex-col sm:flex-row justify-end gap-3 pt-4">
                        <a href="{{ route('books.index') }}" 
                           class="inline-flex items-center justify-center gap-1 px-5 py-2.5 bg-gray-200 text-gray-700 rounded-xl hover:bg-gray-300 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Batal
                        </a>
                        <button type="submit" 
                                class="inline-flex items-center justify-center gap-2 px-6 py-2.5 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-xl hover:from-indigo-700 hover:to-purple-700 transition shadow-md">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Simpan Buku
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>