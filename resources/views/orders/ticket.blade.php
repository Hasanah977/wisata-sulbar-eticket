@extends('layouts.app')

@section('title', 'E-Ticket Resmi — ' . $order->booking_code)

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 py-8">
    <div class="grid grid-cols-3 gap-2 sm:gap-3 mb-8">
        <div class="bg-white border border-slate-200/80 rounded-2xl p-3 flex items-center gap-2.5 text-xs">
            <div class="w-6 h-6 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center shrink-0">
                <i data-lucide="check" class="w-3.5 h-3.5"></i>
            </div>
            <div class="truncate">
                <span class="text-[9px] text-slate-400 uppercase block">Langkah 1</span>
                <strong class="text-slate-700 truncate">01 Rincian Pesanan</strong>
            </div>
        </div>
        <div class="bg-white border border-slate-200/80 rounded-2xl p-3 flex items-center gap-2.5 text-xs">
            <div class="w-6 h-6 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center shrink-0">
                <i data-lucide="check" class="w-3.5 h-3.5"></i>
            </div>
            <div class="truncate">
                <span class="text-[9px] text-slate-400 uppercase block">Langkah 2</span>
                <strong class="text-slate-700 truncate">02 Terverifikasi Lunas</strong>
            </div>
        </div>
        <div class="bg-ocean-700 text-white rounded-2xl p-3 flex items-center gap-2.5 text-xs shadow-xs">
            <div class="w-6 h-6 rounded-full bg-white text-ocean-700 font-bold flex items-center justify-center shrink-0">
                3
            </div>
            <div class="truncate">
                <span class="text-[9px] text-ocean-200 uppercase block">Langkah Selesai</span>
                <strong class="truncate">03 E-Ticket Resmi</strong>
            </div>
        </div>
    </div>

    <div class="text-center max-w-xl mx-auto mb-8">
        <div class="w-12 h-12 rounded-full bg-emerald-500 text-white flex items-center justify-center mx-auto mb-3 shadow-sm">
            <i data-lucide="check" class="w-6 h-6"></i>
        </div>
        <span class="inline-block px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 text-[10px] font-bold uppercase tracking-wider mb-2">
            ● Pembayaran Terverifikasi Lunas
        </span>
        <h1 class="font-display text-2xl sm:text-3xl font-extrabold text-slate-900">
            E-Ticket Siap Digunakan!
        </h1>
        <p class="text-xs text-slate-500 mt-1.5 leading-relaxed">
            Terima kasih, <strong>{{ $order->visitor_name }}</strong>. Kode QR ini berlaku untuk <strong>{{ $order->quantity }}x pemindaian masuk</strong> sesuai jumlah tiket Anda.
        </p>
    </div>

    <div class="bg-white rounded-3xl border border-slate-200/90 shadow-md overflow-hidden grid grid-cols-1 lg:grid-cols-12">
        <div class="lg:col-span-8 p-6 sm:p-8 flex flex-col justify-between border-b lg:border-b-0 lg:border-r-2 lg:border-dashed border-slate-200">
            <div>
                <div class="flex flex-wrap items-center justify-between gap-2 pb-4 border-b border-slate-100">
                    <div class="flex items-center gap-2">
                        <div class="w-7 h-7 rounded-lg bg-ocean-50 text-ocean-600 flex items-center justify-center">
                            <i data-lucide="ticket" class="w-4 h-4"></i>
                        </div>
                        <div>
                            <span class="text-[9px] font-bold uppercase tracking-wider text-ocean-600 block">ExploreSulbar E-Ticket Resmi</span>
                            <strong class="font-display text-xs text-slate-900">Pass Masuk Wisata</strong>
                        </div>
                    </div>
                    <span class="px-3 py-1 rounded-full bg-ocean-50 text-ocean-700 text-[10px] font-bold">
                        KAB. {{ strtoupper($order->destination->regency) }} • POKDARWIS
                    </span>
                </div>

                <div class="my-5 p-4 rounded-2xl bg-slate-50/90 border border-slate-100 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <div>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-ocean-600 block mb-1">
                            Kabupaten {{ $order->destination->regency }}, Sulawesi Barat
                        </span>
                        <h2 class="font-display text-xl font-extrabold text-slate-900">{{ $order->destination->name }}</h2>
                        <p class="text-xs text-slate-500 mt-1 line-clamp-2">{{ $order->destination->description }}</p>
                    </div>
                    <img src="{{ $order->destination->image ?? 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=400' }}"
                         alt="{{ $order->destination->name }}"
                         class="w-full sm:w-32 h-20 rounded-xl object-cover shrink-0">
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 py-4 border-y border-slate-100 text-xs">
                    <div>
                        <span class="text-[10px] font-bold uppercase text-slate-400 block">Tanggal Kunjungan</span>
                        <strong class="text-slate-900 mt-0.5 block">{{ $order->visit_date->format('d M Y') }}</strong>
                    </div>
                    <div>
                        <span class="text-[10px] font-bold uppercase text-slate-400 block">Jam Buka</span>
                        <strong class="text-slate-900 mt-0.5 block">{{ $order->destination->open_hours }}</strong>
                    </div>
                    <div>
                        <span class="text-[10px] font-bold uppercase text-slate-400 block">Nama Pemesan</span>
                        <strong class="text-slate-900 mt-0.5 block">{{ $order->visitor_name }}</strong>
                        <span class="text-[10px] text-slate-500">{{ $order->quantity }} Tiket</span>
                    </div>
                    <div>
                        <span class="text-[10px] font-bold uppercase text-slate-400 block">Kuota Scan QR</span>
                        <strong class="text-ocean-700 mt-0.5 block">{{ $order->ticket->scan_count }} / {{ $order->quantity }} Terpakai</strong>
                    </div>
                </div>
            </div>

            <div class="pt-4 mt-4 flex flex-wrap items-center justify-between gap-2 text-xs">
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                    <span class="text-slate-500 font-medium">Total Terverifikasi:</span>
                    <strong class="font-display text-base font-extrabold text-slate-900">Rp{{ number_format($order->total_price, 0, ',', '.') }}</strong>
                </div>
                <span class="px-3 py-1 rounded-full {{ $order->ticket->status === 'unused' ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-100 text-slate-600' }} text-[11px] font-bold">
                    TERPAKAI {{ $order->ticket->scan_count }} / {{ $order->quantity }} TIKET
                </span>
            </div>
        </div>

        <div class="lg:col-span-4 p-6 sm:p-8 bg-slate-50/50 flex flex-col items-center justify-between text-center">
            <div>
                <span class="text-[10px] font-bold uppercase tracking-wider text-ocean-600 inline-flex items-center gap-1">
                    <i data-lucide="scan-line" class="w-3 h-3"></i>
                    Scan Per Orang Masuk
                </span>
                <p class="text-[11px] text-slate-400 mt-0.5">Pindai 1x untuk setiap pengunjung yang melewati gerbang</p>
            </div>

            <div class="relative p-4 my-4 bg-white rounded-2xl border border-slate-200 shadow-2xs">
                <span class="absolute -top-1 -left-1 w-4 h-4 border-t-2 border-l-2 border-ocean-600 rounded-tl-md"></span>
                <span class="absolute -top-1 -right-1 w-4 h-4 border-t-2 border-r-2 border-ocean-600 rounded-tr-md"></span>
                <span class="absolute -bottom-1 -left-1 w-4 h-4 border-b-2 border-l-2 border-ocean-600 rounded-bl-md"></span>
                <span class="absolute -bottom-1 -right-1 w-4 h-4 border-b-2 border-r-2 border-ocean-600 rounded-br-md"></span>
                {!! $qrSvg !!}
            </div>

            <div class="w-full">
                <span class="text-[9px] font-bold uppercase tracking-widest text-slate-400 block">Kode Unik Booking</span>
                <p class="font-mono font-extrabold text-base text-ocean-700 tracking-wider mt-0.5 mb-4">
                    {{ $order->booking_code }}
                </p>

                <button onclick="window.print()"
                        class="w-full py-2.5 px-4 rounded-full bg-ocean-600 hover:bg-ocean-700 text-white text-xs font-semibold transition inline-flex items-center justify-center gap-1.5 mb-2 cursor-pointer">
                    <i data-lucide="download" class="w-3.5 h-3.5"></i>
                    <span>Unduh / Cetak E-Ticket</span>
                </button>

                <a href="{{ route('home') }}"
                   class="w-full py-2 px-4 rounded-full bg-white border border-slate-200 hover:border-ocean-500 text-slate-700 text-xs font-semibold transition inline-flex items-center justify-center gap-1.5">
                    <span>Kembali ke Beranda</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
