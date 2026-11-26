@extends('layouts.petugas')

@section('title', 'Dashboard Operasional — ExploreSulbar')

@section('content')
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div>
        <h1 class="font-display text-xl font-extrabold text-slate-900">Ringkasan Operasional</h1>
        <p class="text-xs text-slate-500 mt-0.5">Verifikasi pembayaran tiket dan pantau validasi gerbang masuk.</p>
    </div>

    <form action="{{ route('petugas.dashboard') }}" method="GET" class="flex items-center gap-2">
        <input type="date" name="date" value="{{ $date }}"
               class="px-3.5 py-2 bg-white border border-slate-200 rounded-xl text-xs font-medium text-slate-800">
        <button type="submit"
                class="px-4 py-2 bg-ocean-600 hover:bg-ocean-700 text-white text-xs font-semibold rounded-full cursor-pointer">
            Tampilkan
        </button>
    </form>
</div>

<div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
    <div class="bg-white p-5 rounded-2xl border border-slate-200/80 flex items-start justify-between">
        <div>
            <span class="text-xs font-medium text-slate-400">Tiket Terjual (Lunas)</span>
            <p class="font-display text-2xl font-extrabold text-slate-900 mt-1">{{ $totalTicketsSold }} <span class="text-xs font-normal text-slate-400">tiket</span></p>
        </div>
        <div class="p-2.5 rounded-xl bg-ocean-50 text-ocean-600">
            <i data-lucide="ticket" class="w-4 h-4"></i>
        </div>
    </div>

    <div class="bg-white p-5 rounded-2xl border border-slate-200/80 flex items-start justify-between">
        <div>
            <span class="text-xs font-medium text-slate-400">Pengunjung Check-In</span>
            <p class="font-display text-2xl font-extrabold text-ocean-600 mt-1">{{ $checkedInCount }} <span class="text-xs font-normal text-slate-400">orang</span></p>
        </div>
        <div class="p-2.5 rounded-xl bg-emerald-50 text-emerald-600">
            <i data-lucide="user-check" class="w-4 h-4"></i>
        </div>
    </div>

    <div class="bg-white p-5 rounded-2xl border border-slate-200/80 flex items-start justify-between">
        <div>
            <span class="text-xs font-medium text-slate-400">Pendapatan Harian</span>
            <p class="font-display text-2xl font-extrabold text-slate-900 mt-1">Rp{{ number_format($totalRevenue, 0, ',', '.') }}</p>
        </div>
        <div class="p-2.5 rounded-xl bg-ocean-50 text-ocean-600">
            <i data-lucide="wallet" class="w-4 h-4"></i>
        </div>
    </div>
</div>

<div class="bg-white rounded-2xl border border-slate-200/80 overflow-x-auto">
    <table class="w-full text-left text-xs">
        <thead class="bg-slate-50 border-b border-slate-200/80 text-slate-500 font-semibold">
            <tr>
                <th class="p-4">Kode Booking</th>
                <th class="p-4">Destinasi</th>
                <th class="p-4">Pengunjung</th>
                <th class="p-4">Jumlah</th>
                <th class="p-4">Pembayaran</th>
                <th class="p-4">Status QR</th>
                <th class="p-4 text-right">Verifikasi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse($recentOrders as $order)
                <tr class="hover:bg-slate-50/70">
                    <td class="p-4 font-mono font-bold text-slate-900">{{ $order->booking_code }}</td>
                    <td class="p-4 font-medium text-slate-800">{{ $order->destination->name }}</td>
                    <td class="p-4">
                        <span class="font-medium text-slate-800">{{ $order->visitor_name }}</span>
                        <span class="block text-slate-400">{{ $order->visitor_whatsapp }}</span>
                    </td>
                    <td class="p-4 font-semibold">{{ $order->quantity }} org</td>
                    <td class="p-4">
                        @if($order->payment_status === 'paid')
                            <span class="px-2.5 py-1 rounded-full font-semibold bg-emerald-50 text-emerald-700">Lunas</span>
                        @elseif($order->payment_status === 'rejected')
                            <span class="px-2.5 py-1 rounded-full font-semibold bg-red-50 text-red-700">Ditolak</span>
                        @else
                            <span class="px-2.5 py-1 rounded-full font-semibold bg-amber-50 text-amber-700">Menunggu</span>
                        @endif
                    </td>
                    <td class="p-4">
                        @if($order->ticket)
                            <span class="px-2.5 py-1 rounded-full font-semibold {{ $order->ticket->status === 'used' ? 'bg-slate-100 text-slate-600' : 'bg-ocean-50 text-ocean-700' }}">
                                {{ $order->ticket->scan_count }}/{{ $order->quantity }} Scan
                            </span>
                        @else
                            <span class="text-slate-400">Belum Terbit</span>
                        @endif
                    </td>
                    <td class="p-4 text-right">
                        @if($order->payment_status === 'pending')
                            <div class="inline-flex items-center gap-1.5">
                                <form action="{{ route('petugas.orders.approve', $order->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="px-3 py-1.5 rounded-full bg-emerald-600 hover:bg-emerald-700 text-white font-semibold cursor-pointer">
                                        Lunas
                                    </button>
                                </form>
                                <form action="{{ route('petugas.orders.reject', $order->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="px-3 py-1.5 rounded-full bg-red-50 hover:bg-red-100 text-red-700 font-semibold cursor-pointer">
                                        Tolak
                                    </button>
                                </form>
                            </div>
                        @else
                            <span class="text-slate-400">Selesai</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="p-8 text-center text-slate-400">Belum ada transaksi pada tanggal yang dipilih.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
