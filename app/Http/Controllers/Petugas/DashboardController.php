<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->input('date', now()->toDateString());

        $ordersQuery = Order::with(['destination', 'ticket'])
            ->whereDate('visit_date', $date)
            ->orderByDesc('created_at');

        $recentOrders = $ordersQuery->get();

        $totalTicketsSold = Order::whereDate('visit_date', $date)
            ->where('payment_status', 'paid')
            ->sum('quantity');

        $checkedInCount = Ticket::whereHas('order', function ($q) use ($date) {
            $q->whereDate('visit_date', $date)->where('payment_status', 'paid');
        })->sum('scan_count');

        $totalRevenue = Order::whereDate('visit_date', $date)
            ->where('payment_status', 'paid')
            ->sum('total_price');

        return view('petugas.dashboard', compact(
            'date',
            'recentOrders',
            'totalTicketsSold',
            'checkedInCount',
            'totalRevenue'
        ));
    }

    public function approvePayment(Order $order)
    {
        if ($order->payment_status !== 'paid') {
            $order->update([
                'payment_status' => 'paid',
                'paid_at' => now(),
            ]);

            Ticket::firstOrCreate(
                ['order_id' => $order->id],
                [
                    'qr_token' => (string) Str::uuid(),
                    'scan_count' => 0,
                    'status' => 'unused',
                ]
            );
        }

        return back()->with('success', "Pembayaran {$order->booking_code} ({$order->visitor_name}) diverifikasi LUNAS. E-Ticket QR telah aktif.");
    }

    public function rejectPayment(Order $order)
    {
        $order->update([
            'payment_status' => 'rejected',
        ]);

        return back()->with('success', "Pesanan {$order->booking_code} ditandai TIDAK LUNAS / DITOLAK.");
    }
}
