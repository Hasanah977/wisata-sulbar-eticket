@extends('layouts.app')

@section('title', 'Konfirmasi & Pembayaran Tiket — ' . $order->booking_code)

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 py-8">
    <div class="bg-white rounded-3xl border border-slate-200/90 shadow-lg shadow-slate-200/50 overflow-hidden">
        <div class="px-6 sm:px-8 pt-6 pb-5 border-b border-slate-100 flex items-start justify-between">
            <div>
                <div class="flex items-center gap-2 text-[10px] font-bold uppercase tracking-wider mb-1.5">
                    <span class="text-slate-400">01 Rincian</span>
                    <span class="text-slate-300">•</span>
                    <span class="text-ocean-600">02 Pembayaran</span>
                    <span class="text-slate-300">•</span>
                    <span class="text-slate-400">03 E-Ticket</span>
                </div>
                <h1 class="font-display text-xl sm:text-2xl font-extrabold text-slate-900">Konfirmasi & Pembayaran Tiket</h1>
                <p class="text-xs text-slate-500 mt-1 flex items-center gap-1.5">
                    <i data-lucide="map-pin" class="w-3.5 h-3.5 text-ocean-600"></i>
                    <span>{{ $order->destination->name }}, Kab. {{ $order->destination->regency }} • {{ $order->visit_date->format('d M Y') }}</span>
                </p>
            </div>
            <a href="{{ route('home') }}" class="w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-500 flex items-center justify-center">
                <i data-lucide="x" class="w-4 h-4"></i>
            </a>
        </div>

        <div class="p-6 sm:p-8 grid grid-cols-1 lg:grid-cols-12 gap-8">
            <div class="lg:col-span-7 space-y-3.5">
                <div class="flex items-center justify-between">
                    <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Pilih Metode Pembayaran</span>
                    <span class="text-[11px] font-semibold text-amber-600">● Verifikasi Petugas</span>
                </div>

                <div class="p-4 rounded-2xl border-2 border-ocean-600 bg-ocean-50/40">
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-xl bg-white border border-slate-200 flex items-center justify-center text-ocean-600">
                                <i data-lucide="qr-code" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <div class="flex items-center gap-2">
                                    <span class="font-display font-bold text-xs text-slate-900">QRIS Universal</span>
                                    <span class="px-2 py-0.5 rounded bg-emerald-100 text-emerald-700 text-[10px] font-bold">Bebas Admin</span>
                                </div>
                                <p class="text-[11px] text-slate-500">GoPay, OVO, DANA, ShopeePay, BCA, LinkAja</p>
                            </div>
                        </div>
                        <div class="w-5 h-5 rounded-full bg-ocean-600 text-white flex items-center justify-center">
                            <i data-lucide="check" class="w-3 h-3"></i>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl border border-slate-200/80 p-4 text-center">
                        <p class="text-[11px] text-slate-500 mb-2">Scan / Transfer Sesuai Nominal Tagihan</p>
                        <div class="inline-flex items-center justify-center w-24 h-24 rounded-xl bg-slate-50 border border-dashed border-slate-300 text-ocean-600">
                            <i data-lucide="scan-line" class="w-10 h-10"></i>
                        </div>
                        <p class="text-[10px] text-slate-400 mt-2">Setelah melakukan pembayaran, ajukan verifikasi agar petugas mengaktifkan E-Ticket Anda.</p>
                    </div>
                </div>

                <div class="p-3.5 rounded-xl bg-slate-50 text-[11px] text-slate-500 flex items-center gap-2">
                    <i data-lucide="shield-check" class="w-4 h-4 text-ocean-600 shrink-0"></i>
                    <span>Kode Booking: <strong class="font-mono text-slate-800">{{ $order->booking_code }}</strong></span>
                </div>
            </div>

            <div class="lg:col-span-5 bg-slate-50/80 rounded-2xl border border-slate-200/80 p-5 flex flex-col justify-between">
                <div class="space-y-4">
                    <div class="pb-4 border-b border-slate-200/80 flex items-start justify-between">
                        <div>
                            <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Data Pemesan</span>
                            <p class="font-display font-bold text-sm text-slate-900 mt-0.5">{{ $order->visitor_name }}</p>
                            <p class="text-xs text-slate-500">{{ $order->visitor_whatsapp }}</p>
                        </div>
                        <span class="px-2 py-0.5 rounded bg-amber-100 text-amber-800 text-[10px] font-bold uppercase">
                            {{ $order->payment_status }}
                        </span>
                    </div>

                    <div class="space-y-2 text-xs pb-4 border-b border-slate-200/80">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block">Rincian Pesanan</span>
                        <div class="flex justify-between">
                            <span class="text-slate-600">{{ $order->quantity }}x Tiket Masuk Wisata</span>
                            <span class="font-semibold text-slate-900">Rp{{ number_format($order->total_price, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-600">Biaya Layanan Digital</span>
                            <span class="font-semibold text-emerald-600">Gratis (Rp0)</span>
                        </div>
                    </div>

                    <div class="flex items-baseline justify-between pt-1">
                        <div>
                            <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block">Total Tagihan</span>
                            <span class="text-[10px] text-slate-400">Pajak & retribusi terhitung</span>
                        </div>
                        <span class="font-display text-2xl font-extrabold text-ocean-700">
                            Rp{{ number_format($order->total_price, 0, ',', '.') }}
                        </span>
                    </div>
                </div>

                <div class="mt-6">
                    @if($order->payment_status === 'paid')
                        <a href="{{ route('orders.ticket', $order->booking_code) }}"
                           class="w-full py-3.5 px-4 bg-emerald-600 hover:bg-emerald-700 text-white font-display font-bold rounded-full text-xs transition flex items-center justify-center gap-2 shadow-sm">
                            <i data-lucide="qr-code" class="w-4 h-4"></i>
                            <span>Lihat E-Ticket QR Sekarang</span>
                        </a>
                    @elseif($order->payment_status === 'rejected')
                        <div class="p-3.5 rounded-2xl bg-red-50 border border-red-200 text-red-700 text-xs text-center mb-3">
                            <strong>Pembayaran Ditolak / Tidak Valid.</strong><br>
                            Silakan hubungi petugas loket destinasi.
                        </div>
                    @else
                        @if(session('info'))
                            <div class="p-3.5 rounded-2xl bg-amber-50 border border-amber-200 text-amber-800 text-xs mb-3 leading-relaxed">
                                <strong>Menunggu Verifikasi Petugas.</strong><br>
                                {{ session('info') }}
                            </div>
                            <a href="{{ route('orders.payment', $order->booking_code) }}"
                               class="w-full py-3 px-4 bg-ocean-600 hover:bg-ocean-700 text-white font-display font-bold rounded-full text-xs transition flex items-center justify-center gap-2">
                                <i data-lucide="refresh-cw" class="w-3.5 h-3.5"></i>
                                <span>Cek Status Verifikasi</span>
                            </a>
                        @else
                            <form action="{{ route('orders.confirm', $order->booking_code) }}" method="POST">
                                @csrf
                                <button type="submit"
                                        class="w-full py-3.5 px-4 bg-ocean-600 hover:bg-ocean-700 text-white font-display font-bold rounded-full text-xs transition flex items-center justify-center gap-2 shadow-sm cursor-pointer">
                                    <i data-lucide="send" class="w-3.5 h-3.5"></i>
                                    <span>Saya Sudah Bayar (Ajukan Verifikasi)</span>
                                </button>
                            </form>
                        @endif
                    @endif

                    <p class="text-[10px] text-slate-400 text-center mt-2.5">
                        E-Ticket ber-QR Code aktif setelah petugas memverifikasi pembayaran Anda.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
