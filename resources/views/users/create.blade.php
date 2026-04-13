<x-app-layout>
    <x-slot name="header">TAMBAH ANGGOTA</x-slot>

    <div class="bg-white p-6 rounded-2xl shadow max-w-xl">

        <form method="POST" action="{{ route('users.store') }}" class="space-y-4">
            @csrf

            <input name="name" placeholder="Nama" class="w-full border p-2 rounded">
            <input name="email" placeholder="Email" class="w-full border p-2 rounded">
            <input type="password" name="password" placeholder="Password" class="w-full border p-2 rounded">

            <select name="role" class="w-full border p-2 rounded">
                <option value="admin">Admin</option>
                <option value="peminjam">Peminjam</option>
            </select>

            <button class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
        </form>

    </div>
</x-app-layout>