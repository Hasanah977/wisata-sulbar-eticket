<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class ScanController extends Controller
{
    public function index()
    {
        return view('petugas.scan');
    }

    public function verify(Request $request)
    {
        $request->validate(['qr_token' => 'required|string']);

        $ticket = Ticket::with('order.destination')
            ->where('qr_token', $request->qr_token)
            ->first();

        if (!$ticket) {
            return response()->json([
                'status' => 'invalid',
                'title' => 'QR Tidak Dikenal',
                'message' => 'Kode QR tidak terdaftar di sistem ExploreSulbar.',
            ], 404);
        }

        $order = $ticket->order;

        if ($order->payment_status !== 'paid') {
            return response()->json([
                'status' => 'invalid',
                'title' => 'Belum Lunas',
                'message' => 'Pembayaran tiket ini belum diverifikasi lunas oleh petugas.',
            ], 422);
        }

        $maxQuota = (int) $order->quantity;

        if ($ticket->scan_count >= $maxQuota || $ticket->status === 'used') {
            return response()->json([
                'status' => 'used',
                'title' => 'Kuota Scan Habis (' . $ticket->scan_count . '/' . $maxQuota . ')',
                'message' => 'Seluruh tiket pada kode booking ini sudah digunakan masuk.',
                'data' => [
                    'booking_code' => $order->booking_code,
                    'destination' => $order->destination->name,
                    'visitor_name' => $order->visitor_name,
                    'quantity' => $maxQuota,
                    'scan_count' => $ticket->scan_count,
                ]
            ]);
        }

        $newCount = $ticket->scan_count + 1;
        $isFullyUsed = $newCount >= $maxQuota;

        $ticket->update([
            'scan_count' => $newCount,
            'status' => $isFullyUsed ? 'used' : 'unused',
            'scanned_at' => now(),
            'scanned_by' => auth()->id(),
        ]);

        $sisa = $maxQuota - $newCount;

        return response()->json([
            'status' => 'valid',
            'title' => "Valid! Pengunjung ke-{$newCount} dari {$maxQuota}",
            'message' => $sisa > 0
                ? "Silakan masuk. Sisa kuota scan pada QR ini: {$sisa} tiket lagi."
                : "Silakan masuk. Ini adalah scan terakhir (kuota {$maxQuota}/{$maxQuota} terpenuhi).",
            'data' => [
                'booking_code' => $order->booking_code,
                'destination' => $order->destination->name,
                'visitor_name' => $order->visitor_name,
                'quantity' => $maxQuota,
                'scan_count' => $newCount,
            ]
        ]);
    }
}
