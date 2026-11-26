@extends('layouts.app')

@section('title', 'Cek E-Ticket — ExploreSulbar')

@section('content')
<div class="max-w-xl mx-auto px-4 py-12">
    <div class="bg-white rounded-3xl border border-slate-200/90 p-6 sm:p-8 shadow-xs">
        <div class="w-10 h-10 rounded-2xl bg-ocean-50 text-ocean-600 flex items-center justify-center mb-4">
            <i data-lucide="ticket" class="w-5 h-5"></i>
        </div>

        <h1 class="font-display text-xl font-extrabold text-slate-900 mb-1">Cari Ulang E-Ticket Anda</h1>
        <p class="text-xs text-slate-500 mb-6 leading-relaxed">
            Masukkan <strong>Kode Booking</strong> atau <strong>Nomor WhatsApp</strong> yang digunakan saat pemesanan tanpa login.
        </p>

        <form action="{{ route('orders.check') }}" method="GET" class="flex flex-col sm:flex-row gap-2">
            <input type="text" name="keyword" value="{{ request('keyword') }}" required
                   placeholder="Contoh: SB-20261125-XXXXX atau 0812..."
                   class="flex-1 px-4 py-2.5 border border-slate-200 rounded-xl text-xs font-medium focus:outline-none focus:border-ocean-600">
            <button type="submit"
                    class="px-5 py-2.5 bg-ocean-600 hover:bg-ocean-700 text-white font-semibold rounded-full text-xs transition inline-flex items-center justify-center gap-1.5 cursor-pointer">
                <i data-lucide="search" class="w-3.5 h-3.5"></i>
                <span>Cari Tiket</span>
            </button>
        </form>

        @if(request()->filled('keyword'))
            <div class="mt-6 pt-6 border-t border-slate-100 space-y-3">
                @forelse($orders as $item)
                    <div class="p-4 border border-slate-200/90 rounded-2xl flex items-center justify-between gap-4 hover:border-ocean-300 transition">
                        <div>
                            <span class="font-mono text-[11px] font-bold text-ocean-600">{{ $item->booking_code }}</span>
                            <p class="font-display font-bold text-sm text-slate-900 mt-0.5">{{ $item->destination->name }}</p>
                            <p class="text-xs text-slate-500 mt-0.5">{{ $item->visit_date->format('d M Y') }} • {{ $item->quantity }} Orang</p>
                        </div>

                        @if($item->payment_status === 'paid')
                            <a href="{{ route('orders.ticket', $item->booking_code) }}"
                               class="inline-flex items-center gap-1.5 px-4 py-2 bg-ocean-600 hover:bg-ocean-700 text-white text-xs font-semibold rounded-full whitespace-nowrap">
                                <i data-lucide="qr-code" class="w-3.5 h-3.5"></i>
                                <span>Buka QR</span>
                            </a>
                        @else
                            <a href="{{ route('orders.payment', $item->booking_code) }}"
                               class="inline-flex items-center gap-1.5 px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white text-xs font-semibold rounded-full whitespace-nowrap">
                                <span>Bayar</span>
                            </a>
                        @endif
                    </div>
                @empty
                    <p class="text-xs text-center text-slate-400 py-4">Tiket tidak ditemukan. Periksa kembali kode booking atau nomor WhatsApp Anda.</p>
                @endforelse
            </div>
        @endif
    </div>
</div>
@endsection
