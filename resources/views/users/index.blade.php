<x-app-layout>
    <x-slot name="header">
        Data User
    </x-slot>

    <div class="bg-white shadow rounded-2xl p-6">

        {{-- NOTIF --}}
        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-4 p-3 bg-red-100 text-red-700 rounded-lg">
                {{ $errors->first() }}
            </div>
        @endif
        <a href="{{ route('users.create') }}"
                                    class="bg-green-500 text-white px-4 py-2 rounded">
                                        + Tambah Anggota
                                    </a>

        {{-- TABLE --}}
        <div class="overflow-x-auto">
            <table class="w-full border rounded-xl overflow-hidden">

                <thead class="bg-gray-100">
                    <tr class="text-left">
                        <th class="p-3">No</th>
                        <th class="p-3">Nama</th>
                        <th class="p-3">Email</th>
                        <th class="p-3">Role</th>
                        <th class="p-3">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($users as $u)
                    <tr class="border-t">

                        <td class="p-3">{{ $loop->iteration }}</td>

                        <td class="p-3 font-semibold">
                            {{ $u->name }}
                        </td>

                        <td class="p-3">
                            {{ $u->email }}
                        </td>

                        <td class="p-3">
                            <span class="px-3 py-1 text-xs rounded-full
                                {{ $u->role == 'admin' 
                                    ? 'bg-blue-100 text-blue-600' 
                                    : 'bg-green-100 text-green-600' }}">
                                {{ $u->role }}
                            </span>
                        </td>

                        <td class="p-3">

                            {{-- DELETE --}}
                            <form action="{{ route('users.destroy', $u->id) }}" method="POST"
                                  onsubmit="return confirm('Yakin hapus user ini?')">
                                @csrf
                                @method('DELETE')

                                <button class="px-3 py-1 bg-red-500 text-white rounded-lg hover:bg-red-600">
                                    Hapus
                                </button>
                            </form>

                        </td>

                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

    </div>
</x-app-layout>