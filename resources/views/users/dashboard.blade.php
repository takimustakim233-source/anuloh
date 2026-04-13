<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-800">
            Dashboard
        </h2>
    </x-slot>

    <div class="space-y-8">

        {{-- 🔥 STATS --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <div class="bg-white p-6 rounded-2xl shadow border flex items-center justify-between 
                        transform hover:-translate-y-2 hover:shadow-xl transition duration-300">
                <div>
                    <p class="text-sm text-slate-400">Sedang Dipinjam</p>
                    <h3 class="text-3xl font-bold text-yellow-600">
                        {{ $dipinjam }}
                    </h3>
                </div>
                <div class="text-4xl">📚</div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow border flex items-center justify-between 
                        transform hover:-translate-y-2 hover:shadow-xl transition duration-300">
                <div>
                    <p class="text-sm text-slate-400">Menunggu Verifikasi</p>
                    <h3 class="text-3xl font-bold text-blue-600">
                        {{ $pending }}
                    </h3>
                </div>
                <div class="text-4xl">⏳</div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow border flex items-center justify-between 
                        transform hover:-translate-y-2 hover:shadow-xl transition duration-300">
                <div>
                    <p class="text-sm text-slate-400">Sudah Dikembalikan</p>
                    <h3 class="text-3xl font-bold text-green-600">
                        {{ $selesai }}
                    </h3>
                </div>
                <div class="text-4xl">✅</div>
            </div>

        </div>

        {{-- 🔥 WELCOME --}}
        <div class="bg-gradient-to-br from-purple-600 to-indigo-700 rounded-3xl p-8 text-white shadow-xl relative overflow-hidden">
            
            @php
                $quotes = [
                    "Jangan lupa balikin buku ya 😏",
                    "Buku bagus itu yang dibaca 😎",
                    "Telat = denda 😈",
                    "Admin lagi ngawasin 👀",
                ];
            @endphp

            <div class="relative z-10">
                <h3 class="text-2xl font-bold">
                    Halo, {{ Auth::user()->name }} 👋
                </h3>

                <p class="mt-2 text-blue-100">
                    {{ $quotes[array_rand($quotes)] }}
                </p>

                <p class="mt-2 text-sm text-blue-200">
                    @if(now()->hour < 12)
                        🌅 Semangat pagi!
                    @elseif(now()->hour < 18)
                        🌞 Jangan lupa istirahat
                    @else
                        🌙 Jangan begadang 😴
                    @endif
                </p>

                <a href="{{ route('borrowings.create') }}"
                   class="inline-block mt-6 px-6 py-3 bg-white text-blue-600 rounded-xl font-bold hover:bg-blue-50 transition">
                    Pinjam Buku
                </a>
            </div>

            <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
        </div>

        {{-- 🔥 LIST --}}
        <div class="bg-white p-6 rounded-2xl shadow">
            <h3 class="font-semibold text-lg mb-4">
                Peminjaman Terakhir
            </h3>

            @forelse($latest as $b)
                <div class="flex justify-between items-center border-b py-3">
                    <div>
                        <p class="font-semibold">{{ $b->book->title }}</p>
                        <p class="text-sm text-slate-500">
                            {{ $b->borrowed_at }} - {{ $b->return_date }}
                        </p>
                    </div>

                    <span class="text-xs px-3 py-1 rounded-full
                        {{ $b->status == 'pending' ? 'bg-blue-100 text-blue-600' : '' }}
                        {{ $b->status == 'dipinjam' ? 'bg-yellow-100 text-yellow-600' : '' }}
                        {{ $b->status == 'dikembalikan' ? 'bg-green-100 text-green-600' : '' }}">
                        {{ $b->status }}
                    </span>
                </div>
            @empty
                <p class="text-slate-500 text-sm">
                    Belum ada peminjaman
                </p>
            @endforelse
        </div>

    </div>

    {{-- 🎮 FLOATING BOOK --}}
    <div id="floatingBook"
         class="fixed bottom-5 right-5 text-5xl cursor-pointer transition transform hover:scale-125">
        📚
    </div>

    {{-- 🐱 MASKOT INTERAKTIF --}}
    <div id="maskot"
         style="position:fixed; bottom:20px; left:20px; font-size:60px; z-index:9999; cursor:pointer;">
        🐱
    </div>

    <div id="bubble"
         style="position:fixed; bottom:90px; left:20px; background:white; padding:10px 15px; border-radius:12px; box-shadow:0 5px 15px rgba(0,0,0,0.1); display:none;">
    </div>

    {{-- 🎉 SCRIPT --}}
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>

    <script>
        // confetti
        setTimeout(() => {
            confetti({
                particleCount: 80,
                spread: 60,
                origin: { y: 0.7 }
            });
        }, 500);

        // floating book gerak
        const book = document.getElementById('floatingBook');
        setInterval(() => {
            const x = Math.random() * 20 - 10;
            const y = Math.random() * 20 - 10;
            book.style.transform = `translate(${x}px, ${y}px)`;
        }, 1500);

        // klik buku
        const messages = [
            "Balikin buku ya 😏",
            "Telat = denda 😈",
            "Baca buku bikin pinter 📚",
            "Admin lagi ngawasin 👀"
        ];

        book.addEventListener('click', () => {
            alert(messages[Math.floor(Math.random() * messages.length)]);
        });

        // 🐱 MASKOT NGOMONG
        const maskot = document.getElementById('maskot');
        const bubble = document.getElementById('bubble');

        maskot.onclick = () => {
            bubble.innerText = messages[Math.floor(Math.random() * messages.length)];
            bubble.style.display = 'block';

            setTimeout(() => {
                bubble.style.display = 'none';
            }, 2000);
        };

        // 🐱 DRAGGABLE
        let isDragging = false, offsetX, offsetY;

        maskot.addEventListener('mousedown', (e) => {
            isDragging = true;
            offsetX = e.clientX - maskot.offsetLeft;
            offsetY = e.clientY - maskot.offsetTop;
        });

        document.addEventListener('mousemove', (e) => {
            if (isDragging) {
                maskot.style.left = (e.clientX - offsetX) + 'px';
                maskot.style.top = (e.clientY - offsetY) + 'px';
            }
        });

        document.addEventListener('mouseup', () => {
            isDragging = false;
        });

        // 🐱 FLOAT ANIMATION
        maskot.style.animation = "float 2s ease-in-out infinite";

    </script>

    <style>
        @keyframes float {
            0%,100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
    </style>

</x-app-layout>