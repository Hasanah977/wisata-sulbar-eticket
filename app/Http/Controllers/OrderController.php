<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'destination_id' => 'required|exists:destinations,id',
            'visit_date' => 'required|date|after_or_equal:today',
            'visitor_name' => 'required|string|max:120',
            'visitor_whatsapp' => 'required|string|max:25',
            'quantity' => 'required|integer|min:1|max:50',
        ]);

        $destination = Destination::findOrFail($validated['destination_id']);

        $booked = Order::where('destination_id', $destination->id)
            ->whereDate('visit_date', $validated['visit_date'])
            ->whereIn('payment_status', ['pending', 'paid'])
            ->sum('quantity');

        $remaining = max(0, $destination->daily_quota - $booked);
        if ($validated['quantity'] > $remaining) {
            return back()->withErrors(['quantity' => "Kuota tidak mencukupi. Tersisa {$remaining} tiket."])->withInput();
        }

        $bookingCode = 'SB-' . now()->format('Ymd') . '-' . strtoupper(Str::random(5));

        $order = Order::create([
            'booking_code' => $bookingCode,
            'destination_id' => $destination->id,
            'visitor_name' => $validated['visitor_name'],
            'visitor_whatsapp' => $validated['visitor_whatsapp'],
            'visit_date' => $validated['visit_date'],
            'quantity' => $validated['quantity'],
            'total_price' => $destination->price * $validated['quantity'],
            'payment_status' => 'pending',
        ]);

        return redirect()->route('orders.payment', $order->booking_code);
    }

    public function payment($booking_code)
    {
        $order = Order::with('destination')->where('booking_code', $booking_code)->firstOrFail();

        if ($order->payment_status === 'paid' && $order->ticket) {
            return redirect()->route('orders.ticket', $order->booking_code);
        }

        return view('orders.payment', compact('order'));
    }

    public function confirmPayment(Request $request, $booking_code)
    {
        $order = Order::where('booking_code', $booking_code)->firstOrFail();

        if ($order->payment_status === 'paid' && $order->ticket) {
            return redirect()->route('orders.ticket', $order->booking_code);
        }

        $order->update([
            'payment_status' => 'pending',
        ]);

        return redirect()->route('orders.payment', $order->booking_code)
            ->with('info', 'Konfirmasi pembayaran diterima. Menunggu verifikasi petugas sebelum E-Ticket QR diterbitkan.');
    }

    public function ticket($booking_code)
    {
        $order = Order::with(['destination', 'ticket'])
            ->where('booking_code', $booking_code)
            ->firstOrFail();

        if ($order->payment_status !== 'paid' || !$order->ticket) {
            return redirect()->route('orders.payment', $order->booking_code)
                ->with('info', 'Pembayaran Anda belum diverifikasi lunas oleh petugas.');
        }

        $qrSvg = QrCode::size(200)
            ->margin(1)
            ->generate($order->ticket->qr_token);

        return view('orders.ticket', compact('order', 'qrSvg'));
    }

    public function check(Request $request)
    {
        $orders = collect();
        if ($request->filled('keyword')) {
            $kw = trim($request->keyword);
            $orders = Order::with(['destination', 'ticket'])
                ->where('booking_code', $kw)
                ->orWhere('visitor_whatsapp', $kw)
                ->orderByDesc('created_at')
                ->get();
        }

        return view('orders.check', compact('orders'));
    }
}
