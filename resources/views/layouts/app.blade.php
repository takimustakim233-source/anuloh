<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Digital Library') }}</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="font-sans antialiased bg-slate-50 text-slate-900">
    <div class="flex h-screen overflow-hidden">
        
        <aside class="w-72 bg-slate-900 text-white flex flex-col shrink-0 shadow-2xl z-20">
            <div class="h-20 flex items-center px-6 border-b border-slate-800">
                <div class="bg-purple-600 p-2 rounded-xl shadow-lg shadow-purple-500/20 mr-3">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <span class="text-xl font-bold tracking-tight whitespace-nowrap">Digital Library</span>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto custom-scrollbar">
                <p class="px-4 text-[10px] font-bold text-slate-500 uppercase tracking-[0.2em] mb-4">Menu Utama</p>

                {{-- DASHBOARD --}}
                <a href="{{ Auth::user()->role == 'admin' ? route('admin.dashboard') : route('dashboard') }}" 
                class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('*.dashboard') || request()->routeIs('dashboard') ? 'bg-purple-600 text-white shadow-lg shadow-purple-600/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                    <span class="mr-3 text-lg">📊</span>
                    <span class="font-medium">Dashboard</span>
                </a>

                {{-- ADMIN --}}
                @if(Auth::user()->role == 'admin')

                    <a href="{{ route('books.index') }}" 
                    class="flex items-center px-4 py-3 rounded-xl transition-all {{ request()->routeIs('books.*') ? 'bg-purple-600 text-white shadow-lg shadow-purple-600/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                        <span class="mr-3 text-lg">📚</span>
                        <span class="font-medium">Data Buku</span>
                    </a>

                    {{-- ✅ INI YANG SUDAH DIPERBAIKI --}}
                    <a href="{{ route('users.index') }}" 
                    class="flex items-center px-4 py-3 rounded-xl transition-all {{ request()->routeIs('users.*') ? 'bg-purple-600 text-white shadow-lg shadow-purple-600/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                        <span class="mr-3 text-lg">👥</span>
                        <span class="font-medium">Data Anggota</span>
                    </a>

                    <a href="{{ route('borrowings.index') }}" 
                    class="flex items-center px-4 py-3 rounded-xl transition-all {{ request()->routeIs('borrowings.*') ? 'bg-purple-600 text-white shadow-lg shadow-purple-600/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                        <span class="mr-3 text-lg">📖</span>
                        <span class="font-medium">Data Peminjaman</span>
                    </a>

                @endif

                {{-- PEMINJAM --}}
                @if(Auth::user()->role == 'peminjam')

                    <a href="{{ route('borrowings.index') }}" 
                    class="flex items-center px-4 py-3 rounded-xl transition-all {{ request()->routeIs('borrowings.*') ? 'bg-purple-600 text-white shadow-lg shadow-purple-600/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                        <span class="mr-3 text-lg">📖</span>
                        <span class="font-medium">Pinjaman Saya</span>
                    </a>

                @endif

                <!-- {{-- PROFILE --}}
                <div class="pt-4 mt-4 border-t border-slate-800">
                    <a href="{{ route('profile.edit') }}" 
                    class="flex items-center px-4 py-3 rounded-xl transition-all {{ request()->routeIs('profile.*') ? 'bg-purple-600 text-white shadow-lg shadow-purple-600/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                        <span class="mr-3 text-lg">⚙️</span>
                        <span class="font-medium">Pengaturan</span>
                    </a>
                </div> -->
            </nav>

            <div class="p-4 border-t border-slate-800 bg-slate-900/50">
                <div class="flex items-center p-3 mb-3 bg-slate-800/50 rounded-2xl border border-slate-700/50">
                    <div class="w-10 h-10 shrink-0 rounded-xl bg-gradient-to-tr from-purple-600 to-indigo-600 flex items-center justify-center font-bold text-white shadow-inner">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div class="ml-3 overflow-hidden text-left">
                        <p class="text-sm font-bold truncate leading-tight text-white">{{ Auth::user()->name }}</p>
                        <p class="text-[11px] text-slate-500 font-medium uppercase tracking-wider">{{ Auth::user()->role }}</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center justify-center w-full px-4 py-3 bg-red-500/10 text-red-400 hover:bg-red-500 hover:text-white rounded-xl transition-all duration-300 font-semibold group">
                        <span class="mr-2 group-hover:-translate-x-1 transition-transform">🚪</span> Keluar
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-1 flex flex-col min-w-0 bg-slate-50 relative overflow-hidden">
            <header class="h-20 bg-white/80 backdrop-blur-md border-b border-slate-200 flex items-center justify-between px-8 sticky top-0 z-10 shrink-0">
                <div class="flex flex-col">
                    <h2 class="text-xl font-extrabold text-slate-800 tracking-tight">
                        {{ $header ?? 'DASHBOARD UTAMA' }}
                    </h2>
                </div>
            </header>

            <div class="flex-1 overflow-y-auto p-8 lg:p-10 scroll-smooth">
                <div class="max-w-7xl mx-auto">
                    {{ $slot }}
                </div>
            </div>
        </main>
    </div>
</body>
</html>