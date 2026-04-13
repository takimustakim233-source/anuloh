<x-app-layout>
    <x-slot name="header">EDIT ANGGOTA</x-slot>

    <div class="bg-white p-6 rounded-2xl shadow max-w-xl">

        <form method="POST" action="{{ route('users.update', $user->id) }}" class="space-y-4">
            @csrf
            @method('PUT')

            <input name="name" value="{{ $user->name }}" class="w-full border p-2 rounded">
            <input name="email" value="{{ $user->email }}" class="w-full border p-2 rounded">

            <select name="role" class="w-full border p-2 rounded">
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="peminjam" {{ $user->role == 'peminjam' ? 'selected' : '' }}>Peminjam</option>
            </select>

            <button class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
        </form>

    </div>
</x-app-layout>