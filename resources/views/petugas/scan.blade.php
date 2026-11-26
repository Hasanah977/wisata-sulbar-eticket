@extends('layouts.petugas')

@section('title', 'Pemindai QR — ExploreSulbar')

@section('content')
<div class="max-w-md mx-auto">
    <div class="bg-white rounded-3xl border border-slate-200/90 p-6 shadow-xs">
        <div class="flex items-center gap-3 mb-5">
            <div class="w-10 h-10 rounded-2xl bg-ocean-50 text-ocean-600 flex items-center justify-center shrink-0">
                <i data-lucide="scan-line" class="w-5 h-5"></i>
            </div>
            <div>
                <h1 class="font-display text-base font-extrabold text-slate-900">Validasi Gerbang Masuk</h1>
                <p class="text-xs text-slate-500">Pindai 1x per pengunjung yang masuk gerbang.</p>
            </div>
        </div>

        <div id="reader" class="w-full rounded-2xl overflow-hidden border border-slate-200 bg-slate-950"></div>

        <div id="result-box" class="hidden mt-4 p-4 rounded-2xl border text-xs">
            <div class="flex items-start gap-2.5">
                <div id="result-icon" class="mt-0.5 shrink-0"></div>
                <div class="flex-1">
                    <p id="result-title" class="font-display font-bold text-sm mb-0.5"></p>
                    <p id="result-message" class="leading-relaxed"></p>
                </div>
            </div>

            <div id="result-detail" class="hidden mt-3 pt-3 border-t border-current/15 space-y-1.5">
                <div class="flex justify-between">
                    <span class="opacity-75">Kode Booking</span>
                    <strong id="detail-booking" class="font-mono"></strong>
                </div>
                <div class="flex justify-between">
                    <span class="opacity-75">Destinasi</span>
                    <strong id="detail-destination"></strong>
                </div>
                <div class="flex justify-between">
                    <span class="opacity-75">Pengunjung</span>
                    <span><strong id="detail-visitor"></strong> (<span id="detail-qty"></span> terpakai)</span>
                </div>
            </div>

            <button type="button" onclick="resumeScanner()"
                    class="mt-4 w-full py-2.5 bg-ocean-600 hover:bg-ocean-700 text-white font-semibold rounded-full transition cursor-pointer">
                Pindai Pengunjung Berikutnya
            </button>
        </div>

        <div class="mt-5 pt-5 border-t border-slate-100">
            <label class="block text-xs font-semibold text-slate-600 mb-1.5">
                Validasi Manual via UUID Token QR
            </label>
            <div class="flex gap-2">
                <input type="text" id="manual-token" placeholder="Tempel UUID token QR..."
                       class="flex-1 px-3.5 py-2 border border-slate-200 rounded-xl text-xs font-mono focus:outline-none focus:border-ocean-600">
                <button type="button" onclick="verifyManual()"
                        class="px-4 py-2 bg-ocean-600 hover:bg-ocean-700 text-white text-xs font-semibold rounded-full transition cursor-pointer">
                    Cek
                </button>
            </div>
        </div>
    </div>
</div>

<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    let isProcessing = false;

    function showResult(type, payload) {
        const box = document.getElementById('result-box');
        const icon = document.getElementById('result-icon');
        const title = document.getElementById('result-title');
        const message = document.getElementById('result-message');
        const detail = document.getElementById('result-detail');

        box.className = 'mt-4 p-4 rounded-2xl border text-xs';

        if (type === 'valid') {
            box.classList.add('bg-emerald-50', 'border-emerald-200', 'text-emerald-900');
            icon.innerHTML = '<i data-lucide="check-circle-2" class="w-5 h-5 text-emerald-600"></i>';
        } else if (type === 'used') {
            box.classList.add('bg-amber-50', 'border-amber-200', 'text-amber-900');
            icon.innerHTML = '<i data-lucide="alert-triangle" class="w-5 h-5 text-amber-600"></i>';
        } else {
            box.classList.add('bg-red-50', 'border-red-200', 'text-red-900');
            icon.innerHTML = '<i data-lucide="x-circle" class="w-5 h-5 text-red-600"></i>';
        }

        title.textContent = payload.title;
        message.textContent = payload.message;

        if (payload.data) {
            document.getElementById('detail-booking').textContent = payload.data.booking_code;
            document.getElementById('detail-destination').textContent = payload.data.destination;
            document.getElementById('detail-visitor').textContent = payload.data.visitor_name;
            document.getElementById('detail-qty').textContent = `${payload.data.scan_count} / ${payload.data.quantity}`;
            detail.classList.remove('hidden');
        } else {
            detail.classList.add('hidden');
        }

        box.classList.remove('hidden');
        lucide.createIcons();
    }

    async function sendVerification(qrToken) {
        if (isProcessing || !qrToken) return;
        isProcessing = true;

        try {
            const response = await fetch("{{ route('petugas.scan.verify') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ qr_token: qrToken })
            });
            const data = await response.json();
            showResult(data.status || 'invalid', data);
        } catch (error) {
            showResult('invalid', {
                title: 'Koneksi Terputus',
                message: 'Tidak dapat menghubungi server validasi.'
            });
        }
    }

    function verifyManual() {
        const token = document.getElementById('manual-token').value.trim();
        if (token) {
            isProcessing = false;
            sendVerification(token);
        }
    }

    function resumeScanner() {
        document.getElementById('result-box').classList.add('hidden');
        document.getElementById('manual-token').value = '';
        isProcessing = false;
    }

    document.addEventListener('DOMContentLoaded', () => {
        const scanner = new Html5QrcodeScanner("reader", { fps: 10, qrbox: { width: 220, height: 220 } }, false);
        scanner.render((decodedText) => sendVerification(decodedText));
    });
</script>
@endsection
