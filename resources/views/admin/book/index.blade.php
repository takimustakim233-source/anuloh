<x-app-layout>
    <x-slot name="header">
        <div class="bg-indigo-600 px-4 py-3 sm:px-6">
            <div class="flex justify-between items-center">
                <h1 class="text-xl sm:text-2xl font-bold text-white">📚 Perpustakaan Digital</h1>
                <div class="bg-indigo-500 px-3 py-1 rounded-full text-white text-sm font-medium">
                    📖 {{ $books->count() }} Buku
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-6 px-4 sm:px-6 lg:px-8 bg-gray-50 min-h-screen">

        <!-- Add Section -->
        <div class="mb-6">
            <div class="bg-white rounded-lg shadow p-4">
                <div class="flex justify-start">
                    <a href="{{ route('books.create') }}" 
                       class="inline-flex items-center justify-center gap-1 px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition text-sm font-medium">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Tambah Buku
                    </a>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-3 rounded shadow-sm flex justify-between items-center">
                <span>{{ session('success') }}</span>
                <button onclick="this.parentElement.remove()" class="text-green-700 hover:text-green-900">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        @endif

        <div class="mb-6 bg-indigo-50 p-3 rounded-lg border border-indigo-100">
            <p class="text-indigo-800 italic text-sm">💭 "Buku adalah jendela dunia. Baca dan temukan petualanganmu!"</p>
        </div>

        <div>
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-bold text-gray-800">✨ Koleksi Buku</h2>
                <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded-full">{{ $books->count() }} buku</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4" id="booksGrid">
                @forelse($books as $book)
                    <div class="book-card bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition flex flex-col">
                        <div class="h-24 bg-gradient-to-r from-indigo-500 to-indigo-600 p-3 relative">
                            <div class="flex justify-between items-start">
                                <div class="bg-white/20 rounded-lg p-1.5">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                </div>
                                @if($book->stock > 0)
                                    <span class="bg-green-500 text-white text-xs px-2 py-0.5 rounded-full">Tersedia</span>
                                @else
                                    <span class="bg-red-500 text-white text-xs px-2 py-0.5 rounded-full">Habis</span>
                                @endif
                            </div>
                        </div>

                        <div class="p-3 flex-1 flex flex-col">
                            <h3 class="font-bold text-gray-800 text-sm line-clamp-1">{{ $book->title }}</h3>
                            <div class="flex items-center gap-1 text-gray-500 text-xs mt-1">
                                <span>{{ Str::limit($book->author, 25) }}</span>
                            </div>

                            <div class="book-description hidden mt-2 pt-2 border-t border-gray-100 text-xs text-gray-600">
                                <p>{{ Str::limit($book->description ?? 'Belum ada sinopsis', 100) }}</p>
                                <div class="flex justify-between mt-1 text-gray-500">
                                    <span>Stok:</span>
                                    <span class="{{ $book->stock > 0 ? 'text-green-600' : 'text-red-600' }}">{{ $book->stock }}</span>
                                </div>
                            </div>

                            <div class="flex gap-2 mt-3 pt-2">
                                <button onclick="event.stopPropagation(); toggleDetail(this.closest('.book-card'))"
                                        class="flex-1 btn-sinopsis flex items-center justify-center gap-1 px-2 py-1.5 bg-gray-100 text-gray-700 rounded-md text-xs hover:bg-gray-200 transition">
                                    <span>Sinopsis</span>
                                </button>

                                <a href="{{ route('books.edit', $book->id) }}"
                                   class="p-1.5 bg-yellow-500 text-white rounded-md hover:bg-yellow-600 transition">
                                    ✏️
                                </a>

                                <form action="{{ route('books.destroy', $book->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 bg-red-500 text-white rounded-md hover:bg-red-600 transition">
                                        🗑️
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12 bg-white rounded-lg shadow">
                        <h3 class="text-lg font-semibold text-gray-700">Belum ada buku</h3>
                    </div>
                @endforelse
            </div>
        </div>

        <div class="mt-8 text-center text-gray-400 text-xs border-t pt-4">
            📖 Selamat membaca! | {{ date('Y') }} Perpustakaan Digital
        </div>
    </div>

    <script>
        function toggleDetail(card) {
            if (!card) return;
            const desc = card.querySelector('.book-description');
            const btnSpan = card.querySelector('.btn-sinopsis span');
            if (desc.classList.contains('hidden')) {
                desc.classList.remove('hidden');
                if (btnSpan) btnSpan.innerText = 'Tutup';
            } else {
                desc.classList.add('hidden');
                if (btnSpan) btnSpan.innerText = 'Sinopsis';
            }
        }
    </script>
</x-app-layout>