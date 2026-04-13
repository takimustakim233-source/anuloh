<x-app-layout>
    <x-slot name="header">EDIT ANGGOTA</x-slot>

    <div class="bg-white p-6 rounded-2xl shadow max-w-xl">
    </a>
        <form method="POST" action="{{ route('users.update', $user->id) }}">
            @csrf
            @method('PATCH')

            <div class="space-y-4">

                <div>
                    <label class="text-sm">Nama</label>
                    <input 
                        type="text" 
                        name="name" 
                        value="{{ $user->name }}" 
                        required 
                        class="w-full border p-2 rounded"
                    >
                </div>

                <div>
                    <label class="text-sm">Email</label>
                    <input 
                        type="email" 
                        name="email" 
                        value="{{ $user->email }}" 
                        required 
                        class="w-full border p-2 rounded"
                    >
                </div>

                <div>
                    <label class="text-sm">Role</label>
                    <select name="role" class="w-full border p-2 rounded">
                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="peminjam" {{ $user->role == 'peminjam' ? 'selected' : '' }}>Peminjam</option>
                    </select>
                </div>

                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                    Update
                </button>

            </div>
        </form>
        <a href="{{ route('users.index') }}" 
    class="inline-block mb-4 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
        ← Kembali</a>

    </div>
</x-app-layout>