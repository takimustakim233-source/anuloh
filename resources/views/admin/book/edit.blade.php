<x-app-layout>
    <x-slot name="header">
        EDIT BUKU
    </x-slot>

    <div class="bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 min-h-screen px-4 sm:px-6 lg:px-8 py-8">
        <div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-lg overflow-hidden">
            <!-- Header form -->
            <div class="bg-gradient-to-r from-indigo-500 to-purple-600 px-6 py-4">
                <h2 class="text-white font-semibold text-lg flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Form Edit Buku
                </h2>
                <p class="text-indigo-100 text-xs mt-1">Perbarui informasi buku yang sudah ada</p>
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

                <form method="POST" action="{{ route('books.update', $book->id) }}" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <!-- Judul -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">📖 Judul Buku</label>
                            <input type="text" name="title" value="{{ old('title', $book->title) }}" required
                                   class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                        </div>

                        <!-- Author -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">✍️ Penulis</label>
                            <input type="text" name="author" value="{{ old('author', $book->author) }}" required
                                   class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                        </div>

                        <!-- Publisher -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">🏢 Penerbit</label>
                            <input type="text" name="publisher" value="{{ old('publisher', $book->publisher) }}"
                                   class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                        </div>

                        <!-- Tahun -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">📅 Tahun Terbit</label>
                            <input type="text" name="publication_year" value="{{ old('publication_year', $book->publication_year) }}"
                                   class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                        </div>

                        <!-- ISBN -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">🔢 ISBN</label>
                            <input type="text" name="isbn" value="{{ old('isbn', $book->isbn) }}"
                                   class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                        </div>

                        <!-- Stock -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">📦 Stok Buku</label>
                            <input type="number" name="stock" value="{{ old('stock', $book->stock) }}" required
                                   class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                        </div>

                        <!-- Deskripsi -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">📝 Deskripsi</label>
                            <textarea name="description" rows="4"
                                      class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">{{ old('description', $book->description) }}</textarea>
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
                            Update Buku
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>