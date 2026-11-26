<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ExploreSulbar — Tiket Resmi Wisata Sulawesi Barat')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        display: ['Plus Jakarta Sans', 'sans-serif'],
                    },
                    colors: {
                        ice: '#F4F8FB',
                        ocean: {
                            50: '#EFF6FF',
                            100: '#E0F2FE',
                            500: '#0EA5E9',
                            600: '#0284C7',
                            700: '#0369A1',
                            800: '#075985',
                            900: '#0C4A6E',
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-ice text-slate-800 antialiased min-h-screen flex flex-col">
    <!-- Navbar Sesuai Referensi ExploreMajene -->
    <header class="sticky top-0 z-40 bg-white/95 backdrop-blur-md border-b border-slate-200/70">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 h-16 flex items-center justify-between">
            <!-- Brand Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-lg bg-ocean-600 text-white flex items-center justify-center shadow-xs">
                    <i data-lucide="waves" class="w-4 h-4"></i>
                </div>
                <span class="font-display font-bold text-base tracking-tight text-slate-900">
                    Explore<span class="text-ocean-600">Sulbar</span>
                </span>
            </a>

            <!-- Menu Tengah -->
            <nav class="hidden md:flex items-center gap-1 text-xs font-semibold">
                <a href="{{ route('home') }}"
                   class="px-4 py-2 rounded-full transition {{ request()->routeIs('home') && !request('regency') ? 'bg-ocean-600 text-white' : 'text-slate-600 hover:text-ocean-600' }}">
                    Beranda
                </a>
                <a href="{{ route('home') }}#katalog"
                   class="px-4 py-2 rounded-full transition {{ request('regency') ? 'bg-ocean-600 text-white' : 'text-slate-600 hover:text-ocean-600' }}">
                    Destinasi
                </a>
                <a href="{{ route('orders.check') }}"
                   class="px-4 py-2 rounded-full transition {{ request()->routeIs('orders.check') ? 'bg-ocean-600 text-white' : 'text-slate-600 hover:text-ocean-600' }}">
                    Cek E-Ticket
                </a>
            </nav>

            <!-- Aksi Kanan -->
            <div class="flex items-center gap-2.5">
                <a href="{{ route('orders.check') }}"
                   class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-full bg-ocean-50 text-ocean-700 hover:bg-ocean-100 text-xs font-semibold transition">
                    <i data-lucide="ticket" class="w-3.5 h-3.5"></i>
                    <span>Tiket Saya</span>
                </a>
                <a href="{{ route('petugas.login') }}"
                   class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full bg-ocean-600 hover:bg-ocean-700 text-white text-xs font-semibold shadow-xs transition">
                    <span>Petugas</span>
                </a>
            </div>
        </div>
    </header>

    <!-- Konten Utama -->
    <main class="flex-1">
        @yield('content')
    </main>

    <!-- Footer 4 Kolom Sesuai Referensi -->
    <footer class="bg-ocean-50/70 border-t border-slate-200/80 mt-20">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 py-12">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-8 pb-8 border-b border-slate-200/80">
                <div class="md:col-span-5 space-y-3">
                    <div class="flex items-center gap-2">
                        <div class="w-7 h-7 rounded-lg bg-ocean-600 text-white flex items-center justify-center">
                            <i data-lucide="waves" class="w-4 h-4"></i>
                        </div>
                        <span class="font-display font-bold text-base text-slate-900">ExploreSulbar</span>
                    </div>
                    <p class="text-xs text-slate-500 leading-relaxed max-w-xs">
                        Temukan dan pesan pengalaman wisata bahari maupun pegunungan terbaik di Provinsi Sulawesi Barat secara instan tanpa login.
                    </p>
                    <span class="inline-block px-3 py-1 rounded-full bg-ocean-100/80 text-ocean-800 text-[10px] font-bold tracking-wider uppercase">
                        SULAWESI BARAT • WONDERFUL INDONESIA
                    </span>
                </div>

                <div class="md:col-span-3 space-y-2 text-xs">
                    <p class="font-display font-bold text-slate-900 mb-3">Wilayah Kabupaten</p>
                    <ul class="space-y-2 text-slate-500">
                        <li><a href="{{ route('home', ['regency' => 'Majene']) }}" class="hover:text-ocean-600">Kabupaten Majene</a></li>
                        <li><a href="{{ route('home', ['regency' => 'Polewali Mandar']) }}" class="hover:text-ocean-600">Polewali Mandar</a></li>
                        <li><a href="{{ route('home', ['regency' => 'Mamuju']) }}" class="hover:text-ocean-600">Kabupaten Mamuju</a></li>
                        <li><a href="{{ route('home', ['regency' => 'Mamasa']) }}" class="hover:text-ocean-600">Kabupaten Mamasa</a></li>
                    </ul>
                </div>

                <div class="md:col-span-2 space-y-2 text-xs">
                    <p class="font-display font-bold text-slate-900 mb-3">Layanan</p>
                    <ul class="space-y-2 text-slate-500">
                        <li><a href="{{ route('home') }}" class="hover:text-ocean-600">Katalog Wisata</a></li>
                        <li><a href="{{ route('orders.check') }}" class="hover:text-ocean-600">Cari Kode Booking</a></li>
                        <li><a href="{{ route('petugas.login') }}" class="hover:text-ocean-600">Portal Petugas</a></li>
                    </ul>
                </div>

                <div class="md:col-span-2 space-y-2 text-xs">
                    <p class="font-display font-bold text-slate-900 mb-3">Informasi</p>
                    <ul class="space-y-2 text-slate-500">
                        <li>E-Ticket QR Resmi</li>
                        <li>Verifikasi Instan</li>
                        <li>Pokdarwis Sulbar</li>
                    </ul>
                </div>
            </div>

            <div class="pt-6 flex flex-col sm:flex-row items-center justify-between text-[11px] text-slate-400 gap-2">
                <p>&copy; {{ date('Y') }} ExploreSulbar. Hak Cipta Dilindungi.</p>
                <p>Provinsi Sulawesi Barat, Indonesia</p>
            </div>
        </div>
    </footer>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>