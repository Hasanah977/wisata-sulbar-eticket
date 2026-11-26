@extends('layouts.app')

@section('title', 'ExploreSulbar — Jelajahi Keindahan Wisata Sulawesi Barat')

@section('content')
<!-- Hero Banner dengan Floating Search Bar -->
<section class="max-w-6xl mx-auto px-4 sm:px-6 pt-5">
    <div class="relative rounded-3xl overflow-hidden bg-slate-900 h-[380px] sm:h-[420px] flex items-center">
        <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=1400"
             alt="Pesisir Sulawesi Barat"
             class="absolute inset-0 w-full h-full object-cover opacity-70">
        <div class="absolute inset-0 bg-gradient-to-r from-slate-950/85 via-slate-900/50 to-transparent"></div>

        <div class="relative z-10 px-6 sm:px-12 max-w-2xl text-white">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/15 backdrop-blur-xs text-[11px] font-semibold tracking-wide uppercase mb-4">
                <i data-lucide="compass" class="w-3.5 h-3.5 text-ocean-400"></i>
                E-Ticket Wisata Resmi Sulbar
            </span>

            <h1 class="font-display text-3xl sm:text-5xl font-extrabold leading-tight mb-3">
                Jelajahi Keindahan Sulawesi Barat
            </h1>

            <p class="text-slate-200 text-xs sm:text-sm leading-relaxed mb-6 max-w-lg">
                Temukan destinasi bahari, tebing karang, dan pesona pegunungan di 6 kabupaten. Pesan tiket tanpa perlu login, langsung dapat kode QR.
            </p>

            <div class="flex flex-wrap items-center gap-3">
                <a href="#katalog"
                   class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-ocean-600 hover:bg-ocean-500 text-white text-xs font-semibold transition">
                    <span>Jelajahi Destinasi</span>
                    <i data-lucide="arrow-down" class="w-3.5 h-3.5"></i>
                </a>
                <a href="{{ route('orders.check') }}"
                   class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-white/15 hover:bg-white/25 backdrop-blur-xs text-white text-xs font-semibold transition">
                    <span>Cek Tiket Saya</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Floating Search & Filter Bar -->
    <form action="{{ route('home') }}#katalog" method="GET"
          class="relative z-20 -mt-8 mx-3 sm:mx-8 bg-white rounded-2xl shadow-lg shadow-slate-200/70 border border-slate-200/80 p-3 sm:p-4">
        <div class="grid grid-cols-1 sm:grid-cols-12 gap-3 items-center">
            <div class="sm:col-span-5 flex items-center gap-2.5 px-3 py-2 bg-slate-50 rounded-xl border border-slate-200/70">
                <i data-lucide="search" class="w-4 h-4 text-ocean-600 shrink-0"></i>
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Cari pantai, pulau, atau wisata alam..."
                       class="w-full bg-transparent text-xs font-medium text-slate-800 placeholder:text-slate-400 focus:outline-none">
            </div>

            <div class="sm:col-span-4 flex items-center gap-2.5 px-3 py-2 bg-slate-50 rounded-xl border border-slate-200/70">
                <i data-lucide="map-pin" class="w-4 h-4 text-ocean-600 shrink-0"></i>
                <select name="regency" class="w-full bg-transparent text-xs font-medium text-slate-800 focus:outline-none">
                    <option value="">Semua Kabupaten (6 Wilayah)</option>
                    @foreach($regencies as $reg)
                        <option value="{{ $reg }}" {{ request('regency') === $reg ? 'selected' : '' }}>
                            Kab. {{ $reg }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="sm:col-span-3">
                <button type="submit"
                        class="w-full py-2.5 px-4 bg-ocean-600 hover:bg-ocean-700 text-white text-xs font-semibold rounded-xl transition flex items-center justify-center gap-2 cursor-pointer">
                    <i data-lucide="search" class="w-3.5 h-3.5"></i>
                    <span>Cari Wisata</span>
                </button>
            </div>
        </div>
    </form>
</section>

<!-- Katalog Destinasi -->
<section id="katalog" class="max-w-6xl mx-auto px-4 sm:px-6 pt-12">
    <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-6">
        <div>
            <span class="text-[11px] font-bold uppercase tracking-wider text-ocean-600">Eksplorasi Sulawesi Barat</span>
            <h2 class="font-display text-2xl sm:text-3xl font-extrabold text-slate-900 mt-1">
                Destinasi Wisata Pilihan
            </h2>
        </div>

        <div class="inline-flex items-center gap-2.5 px-4 py-2 rounded-2xl bg-white border border-slate-200/80 text-xs">
            <div class="w-7 h-7 rounded-lg bg-ocean-50 text-ocean-600 flex items-center justify-center">
                <i data-lucide="map" class="w-3.5 h-3.5"></i>
            </div>
            <div>
                <span class="font-bold text-slate-900 block leading-none">{{ $destinations->count() }} Destinasi</span>
                <span class="text-[10px] text-slate-400">Tersedia E-Ticket</span>
            </div>
        </div>
    </div>

    <!-- Pill Filter Kabupaten -->
    <div class="flex items-center gap-2 overflow-x-auto pb-4 mb-4">
        <a href="{{ route('home', ['search' => request('search')]) }}#katalog"
           class="px-4 py-1.5 rounded-full text-xs font-semibold whitespace-nowrap transition {{ !request('regency') ? 'bg-ocean-600 text-white shadow-xs' : 'bg-white text-slate-600 border border-slate-200 hover:border-ocean-500' }}">
            Semua ({{ $destinations->count() }})
        </a>
        @foreach($regencies as $regency)
            <a href="{{ route('home', ['regency' => $regency, 'search' => request('search')]) }}#katalog"
               class="px-4 py-1.5 rounded-full text-xs font-semibold whitespace-nowrap transition {{ request('regency') === $regency ? 'bg-ocean-600 text-white shadow-xs' : 'bg-white text-slate-600 border border-slate-200 hover:border-ocean-500' }}">
                {{ $regency }}
            </a>
        @endforeach
    </div>

    @if($destinations->isEmpty())
        <div class="bg-white rounded-3xl border border-slate-200/80 p-12 text-center max-w-md mx-auto">
            <i data-lucide="search-x" class="w-10 h-10 text-slate-300 mx-auto mb-3"></i>
            <h3 class="font-display font-bold text-base text-slate-900">Destinasi Tidak Ditemukan</h3>
            <p class="text-xs text-slate-500 mt-1 mb-4">Coba kata kunci lain atau tampilkan semua kabupaten.</p>
            <a href="{{ route('home') }}#katalog" class="inline-block px-4 py-2 bg-ocean-600 text-white text-xs font-semibold rounded-full">
                Reset Pencarian
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($destinations as $item)
                <article class="group bg-white rounded-2xl border border-slate-200/80 overflow-hidden shadow-xs hover:shadow-md transition-all flex flex-col">
                    <div class="relative h-48 overflow-hidden bg-slate-200">
                        <img src="{{ $item->image ?? 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=800' }}"
                             alt="{{ $item->name }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/60 via-transparent to-transparent"></div>

                        <span class="absolute top-3 left-3 px-2.5 py-1 rounded-md bg-white/95 text-slate-800 text-[10px] font-bold uppercase tracking-wider">
                            E-Ticket Aktif
                        </span>

                        <div class="absolute bottom-2.5 left-3 right-3 flex items-center justify-between text-white text-[11px]">
                            <span class="inline-flex items-center gap-1 font-medium">
                                <i data-lucide="clock" class="w-3 h-3 text-ocean-300"></i>
                                {{ $item->open_hours }}
                            </span>
                        </div>
                    </div>

                    <div class="p-5 flex-1 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between text-[11px] text-slate-400 mb-1">
                                <span class="inline-flex items-center gap-1 text-ocean-700 font-semibold">
                                    <i data-lucide="map-pin" class="w-3 h-3"></i>
                                    Kab. {{ $item->regency }}
                                </span>
                                <span>Kuota {{ $item->daily_quota }}/hari</span>
                            </div>

                            <h3 class="font-display font-bold text-base text-slate-900 group-hover:text-ocean-600 transition mb-1.5">
                                {{ $item->name }}
                            </h3>

                            <p class="text-xs text-slate-500 line-clamp-2 leading-relaxed mb-4">
                                {{ $item->description }}
                            </p>

                            <div class="grid grid-cols-3 gap-1.5 mb-4 text-[10px] text-slate-600">
                                <div class="px-2 py-1.5 rounded-lg bg-slate-50 border border-slate-100 flex items-center gap-1 truncate">
                                    <i data-lucide="qr-code" class="w-3 h-3 text-ocean-600 shrink-0"></i>
                                    <span class="truncate">QR Instan</span>
                                </div>
                                <div class="px-2 py-1.5 rounded-lg bg-slate-50 border border-slate-100 flex items-center gap-1 truncate">
                                    <i data-lucide="user-check" class="w-3 h-3 text-ocean-600 shrink-0"></i>
                                    <span class="truncate">Tanpa Login</span>
                                </div>
                                <div class="px-2 py-1.5 rounded-lg bg-slate-50 border border-slate-100 flex items-center gap-1 truncate">
                                    <i data-lucide="shield-check" class="w-3 h-3 text-ocean-600 shrink-0"></i>
                                    <span class="truncate">Resmi</span>
                                </div>
                            </div>
                        </div>

                        <div class="pt-3.5 border-t border-slate-100 flex items-center justify-between">
                            <div>
                                <span class="text-[10px] text-slate-400 block">Tiket Masuk</span>
                                <span class="font-display font-extrabold text-slate-900 text-base">
                                    Rp{{ number_format($item->price, 0, ',', '.') }}
                                    <span class="text-[11px] font-normal text-slate-400">/orang</span>
                                </span>
                            </div>

                            <a href="{{ route('destinations.show', $item->slug) }}"
                               class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full bg-ocean-600 hover:bg-ocean-700 text-white text-xs font-semibold transition">
                                <span>Detail</span>
                                <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                            </a>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    @endif

    <!-- Banner 3 Langkah Mudah -->
    <div class="mt-16 text-center">
        <span class="text-[10px] font-bold uppercase tracking-widest text-ocean-600">Langkah Mudah</span>
        <h3 class="font-display text-xl sm:text-2xl font-extrabold text-slate-900 mt-1 mb-6">
            Booking Jadi Lebih Mudah
        </h3>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 text-left">
            <div class="bg-white rounded-2xl border border-slate-200/80 p-6">
                <span class="inline-flex w-8 h-8 rounded-lg bg-ocean-50 text-ocean-700 font-display font-bold text-xs items-center justify-center mb-3">01</span>
                <h4 class="font-display font-bold text-sm text-slate-900 mb-1">Pilih Destinasi</h4>
                <p class="text-xs text-slate-500 leading-relaxed">Cari destinasi wisata favorit di Sulawesi Barat dan tentukan tanggal kunjungan Anda.</p>
            </div>
            <div class="bg-white rounded-2xl border border-slate-200/80 p-6">
                <span class="inline-flex w-8 h-8 rounded-lg bg-ocean-50 text-ocean-700 font-display font-bold text-xs items-center justify-center mb-3">02</span>
                <h4 class="font-display font-bold text-sm text-slate-900 mb-1">Bayar Instan Tanpa Akun</h4>
                <p class="text-xs text-slate-500 leading-relaxed">Isi nama & nomor WhatsApp tanpa perlu registrasi akun, lalu konfirmasi pembayaran.</p>
            </div>
            <div class="bg-white rounded-2xl border border-slate-200/80 p-6">
                <span class="inline-flex w-8 h-8 rounded-lg bg-ocean-50 text-ocean-700 font-display font-bold text-xs items-center justify-center mb-3">03</span>
                <h4 class="font-display font-bold text-sm text-slate-900 mb-1">Datang & Scan QR</h4>
                <p class="text-xs text-slate-500 leading-relaxed">Kode QR langsung terbit di layar. Tunjukkan kepada petugas loket saat tiba di lokasi.</p>
            </div>
        </div>
    </div>
</section>
@endsection
