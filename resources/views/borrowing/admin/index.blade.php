<x-app-layout>
    <x-slot name="header">
        Data Peminjaman
    </x-slot>

    <div class="space-y-6">

        {{-- NOTIF --}}
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded-xl">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded-xl">
                {{ $errors->first() }}
            </div>
        @endif

        {{-- LIST --}}
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">

            @foreach($borrowings as $b)
            <div class="bg-white p-5 rounded-2xl shadow">

                <h3 class="font-bold text-lg">
                    {{ $b->book->title }}
                </h3>

                <p class="text-sm text-gray-500">
                    User: {{ $b->user->name }}
                </p>

                <p class="text-sm">Pinjam: {{ $b->borrowed_at }}</p>
                <p class="text-sm">Kembali: {{ $b->return_date }}</p>

                {{-- STATUS --}}
                <div class="mt-2">
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
                <div class="mt-4 flex flex-wrap gap-2">

                    @php $user = auth()->user(); @endphp

                    {{-- ================= ADMIN ================= --}}

                    {{-- APPROVE PINJAM --}}
                    @if($user->role === 'admin' && $b->status == 'pending')
                    <form action="{{ route('borrowings.approve', $b->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button class="bg-blue-500 text-white px-3 py-1 rounded">
                            Approve Pinjam
                        </button>
                    </form>
                    @endif

                    {{-- APPROVE PENGEMBALIAN --}}
                    @if($user->role === 'admin' && $b->status == 'kembali_req')
                    <form action="{{ route('borrowings.approveReturn', $b->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button class="bg-green-500 text-white px-3 py-1 rounded">
                            Approve Kembali
                        </button>
                    </form>
                    @endif

                    {{-- ================= USER ================= --}}

                    {{-- AJUKAN PENGEMBALIAN --}}
                    @if($user->role === 'user' && $b->user_id == $user->id && $b->status == 'dipinjam')
                    <form action="{{ route('borrowings.requestReturn', $b->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button class="bg-yellow-500 text-white px-3 py-1 rounded">
                            Ajukan Kembali
                        </button>
                    </form>
                    @endif

                    {{-- ================= DELETE ================= --}}

                    {{-- ADMIN --}}
                    @if($user->role === 'admin')
                    <form action="{{ route('borrowings.destroy', $b->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Hapus data?')"
                            class="bg-red-500 text-white px-3 py-1 rounded-lg">
                            Hapus
                        </button>
                    </form>
                    @endif

                    {{-- USER --}}
                    @if($user->role === 'user' && $b->user_id == $user->id && $b->status == 'pending')
                    <form action="{{ route('borrowings.destroy', $b->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Batalkan peminjaman?')"
                            class="bg-red-400 text-white px-3 py-1 rounded-lg">
                            Batalkan
                        </button>
                    </form>
                    @endif

                </div>

            </div>
            @endforeach

        </div>

    </div>
</x-app-layout>