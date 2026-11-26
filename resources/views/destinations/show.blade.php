@extends('layouts.app')

@section('title', $destination->name . ' — ExploreSulbar')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 py-6">
    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-xs text-slate-400 mb-4">
        <a href="{{ route('home') }}" class="hover:text-ocean-600">Beranda</a>
        <span>/</span>
        <a href="{{ route('home', ['regency' => $destination->regency]) }}" class="hover:text-ocean-600">{{ $destination->regency }}</a>
        <span>/</span>
        <span class="text-slate-700 font-medium">{{ $destination->name }}</span>
    </nav>

    <!-- Header Judul -->
    <div class="mb-5">
        <div class="flex flex-wrap items-center gap-2.5 mb-1.5">
            <h1 class="font-display text-2xl sm:text-3xl font-extrabold text-slate-900">{{ $destination->name }}</h1>
            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-ocean-50 text-ocean-700 text-[11px] font-semibold">
                <i data-lucide="badge-check" class="w-3.5 h-3.5"></i>
                Destinasi Resmi Sulbar
            </span>
        </div>
        <div class="flex flex-wrap items-center gap-4 text-xs text-slate-500">
            <span class="inline-flex items-center gap-1">
                <i data-lucide="map-pin" class="w-3.5 h-3.5 text-ocean-600"></i>
                Kabupaten {{ $destination->regency }}, Sulawesi Barat
            </span>
            <span class="inline-flex items-center gap-1">
                <i data-lucide="clock" class="w-3.5 h-3.5 text-ocean-600"></i>
                {{ $destination->open_hours }}
            </span>
        </div>
    </div>

    <!-- Galeri Foto Kolase (Sesuai Referensi Gambar 3) -->
    <div class="grid grid-cols-1 md:grid-cols-12 gap-3 rounded-3xl overflow-hidden mb-8">
        <div class="md:col-span-7 h-64 sm:h-80 bg-slate-200 relative">
            <img src="{{ $destination->image ?? 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=1000' }}"
                 alt="{{ $destination->name }}"
                 class="w-full h-full object-cover">
            <span class="absolute bottom-3 left-3 px-3 py-1 rounded-full bg-slate-900/75 text-white text-[11px] font-medium">
                Panorama Utama {{ $destination->name }}
            </span>
        </div>
        <div class="hidden md:grid md:col-span-5 grid-cols-2 gap-3 h-80">
            <img src="https://images.unsplash.com/photo-1519046904884-53103b34b206?w=500" alt="Suasana" class="w-full h-full object-cover">
            <img src="https://images.unsplash.com/photo-1473116763249-2faaef81ccda?w=500" alt="Pesisir" class="w-full h-full object-cover">
            <img src="https://images.unsplash.com/photo-1506929562872-bb421503ef21?w=500" alt="Spot Foto" class="w-full h-full object-cover">
            <img src="https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?w=500" alt="Alam" class="w-full h-full object-cover">
        </div>
    </div>

    <!-- Konten 2 Kolom: Kiri Info & Kanan Form Booking Sticky -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        <div class="lg:col-span-8 space-y-6">
            <!-- Strip Info Cepat -->
            <div class="grid grid-cols-3 gap-3 bg-white p-4 rounded-2xl border border-slate-200/80 text-xs">
                <div class="flex items-center gap-2.5">
                    <div class="p-2 rounded-xl bg-ocean-50 text-ocean-600">
                        <i data-lucide="clock" class="w-4 h-4"></i>
                    </div>
                    <div>
                        <span class="text-[10px] text-slate-400 block">Jam Operasional</span>
                        <strong class="text-slate-800">{{ $destination->open_hours }}</strong>
                    </div>
                </div>
                <div class="flex items-center gap-2.5">
                    <div class="p-2 rounded-xl bg-ocean-50 text-ocean-600">
                        <i data-lucide="users" class="w-4 h-4"></i>
                    </div>
                    <div>
                        <span class="text-[10px] text-slate-400 block">Kuota Harian</span>
                        <strong class="text-slate-800">{{ $destination->daily_quota }} Tiket</strong>
                    </div>
                </div>
                <div class="flex items-center gap-2.5">
                    <div class="p-2 rounded-xl bg-ocean-50 text-ocean-600">
                        <i data-lucide="qr-code" class="w-4 h-4"></i>
                    </div>
                    <div>
                        <span class="text-[10px] text-slate-400 block">Metode Masuk</span>
                        <strong class="text-slate-800">Scan QR Digital</strong>
                    </div>
                </div>
            </div>

            <!-- Deskripsi Destinasi -->
            <div class="bg-white p-6 rounded-2xl border border-slate-200/80">
                <h2 class="font-display font-bold text-lg text-slate-900 mb-3">Tentang Destinasi</h2>
                <p class="text-sm text-slate-600 leading-relaxed">{{ $destination->description }}</p>

                <div class="mt-6 pt-5 border-t border-slate-100">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-3">Ketentuan E-Ticket</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-2.5 text-xs text-slate-700">
                        <div class="p-3 rounded-xl bg-slate-50 flex items-center gap-2">
                            <i data-lucide="check-circle-2" class="w-4 h-4 text-ocean-600 shrink-0"></i>
                            <span>Tanpa Perlu Buat Akun</span>
                        </div>
                        <div class="p-3 rounded-xl bg-slate-50 flex items-center gap-2">
                            <i data-lucide="check-circle-2" class="w-4 h-4 text-ocean-600 shrink-0"></i>
                            <span>1 QR untuk Rombongan</span>
                        </div>
                        <div class="p-3 rounded-xl bg-slate-50 flex items-center gap-2">
                            <i data-lucide="check-circle-2" class="w-4 h-4 text-ocean-600 shrink-0"></i>
                            <span>Validasi Cepat di Loket</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kartu Booking Sticky Kanan (Sesuai Referensi Gambar 3) -->
        <div class="lg:col-span-4 bg-white rounded-2xl border border-slate-200/90 p-6 shadow-sm lg:sticky lg:top-22">
            <div class="flex items-start justify-between pb-4 border-b border-slate-100">
                <div>
                    <span class="text-[11px] text-slate-400 block">Mulai dari</span>
                    <span class="font-display text-2xl font-extrabold text-slate-900">
                        Rp{{ number_format($destination->price, 0, ',', '.') }}
                    </span>
                    <span class="text-xs text-slate-400">/orang</span>
                </div>
                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold {{ $remainingQuota > 0 ? 'bg-emerald-50 text-emerald-700' : 'bg-red-50 text-red-700' }}">
                    Sisa {{ $remainingQuota }} Kuota
                </span>
            </div>

            <!-- Cek Tanggal -->
            <form action="{{ route('destinations.show', $destination->slug) }}" method="GET" class="mt-4">
                <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-400 mb-1.5">Tanggal Kunjungan</label>
                <div class="flex gap-2">
                    <input type="date" name="date" value="{{ $selectedDate }}" min="{{ now()->toDateString() }}"
                           class="flex-1 px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800">
                    <button type="submit" class="px-3.5 py-2 bg-ocean-50 text-ocean-700 hover:bg-ocean-100 text-xs font-semibold rounded-xl cursor-pointer">
                        Cek
                    </button>
                </div>
            </form>

            @if ($errors->any())
                <div class="mt-3 p-3 bg-red-50 border border-red-200 text-red-700 text-xs rounded-xl">
                    {{ $errors->first() }}
                </div>
            @endif

            <!-- Form Pemesanan -->
            <form action="{{ route('orders.store') }}" method="POST" class="mt-4 pt-4 border-t border-slate-100 space-y-3.5">
                @csrf
                <input type="hidden" name="destination_id" value="{{ $destination->id }}">
                <input type="hidden" name="visit_date" value="{{ $selectedDate }}">

                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-400 mb-1">Nama Pemesan</label>
                    <input type="text" name="visitor_name" value="{{ old('visitor_name') }}" required placeholder="Contoh: Rian Anugrah"
                           class="w-full px-3.5 py-2.5 border border-slate-200 rounded-xl text-xs font-medium focus:outline-none focus:border-ocean-600">
                </div>

                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-400 mb-1">Nomor WhatsApp</label>
                    <input type="tel" name="visitor_whatsapp" value="{{ old('visitor_whatsapp') }}" required placeholder="0812xxxxxxxx"
                           class="w-full px-3.5 py-2.5 border border-slate-200 rounded-xl text-xs font-medium focus:outline-none focus:border-ocean-600">
                </div>

                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-400 mb-1">Jumlah Tiket</label>
                    <input type="number" name="quantity" value="{{ old('quantity', 1) }}" min="1" max="{{ max(1, $remainingQuota) }}" required
                           class="w-full px-3.5 py-2.5 border border-slate-200 rounded-xl text-xs font-bold focus:outline-none focus:border-ocean-600">
                </div>

                <button type="submit"
                        {{ $remainingQuota < 1 ? 'disabled' : '' }}
                        class="w-full py-3 bg-ocean-600 hover:bg-ocean-700 disabled:bg-slate-300 text-white font-display font-bold rounded-full text-xs transition flex items-center justify-center gap-2 shadow-xs cursor-pointer">
                    <span>{{ $remainingQuota > 0 ? 'Pesan Tiket Sekarang' : 'Kuota Penuh' }}</span>
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </button>

                <div class="pt-2 space-y-1 text-[11px] text-slate-400">
                    <p class="flex items-center gap-1.5"><i data-lucide="zap" class="w-3 h-3 text-ocean-600"></i> E-Ticket QR langsung terbit setelah bayar</p>
                    <p class="flex items-center gap-1.5"><i data-lucide="lock" class="w-3 h-3 text-ocean-600"></i> Tanpa perlu daftar atau login akun</p>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
