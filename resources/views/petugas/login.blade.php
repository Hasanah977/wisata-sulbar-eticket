<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Petugas — ExploreSulbar</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-[#F4F8FB] font-['Inter'] min-h-screen flex items-center justify-center px-4">
    <div class="max-w-sm w-full bg-white rounded-3xl border border-slate-200/90 p-7 shadow-sm">
        <div class="w-10 h-10 rounded-xl bg-sky-600 text-white flex items-center justify-center mb-4">
            <i data-lucide="shield-check" class="w-5 h-5"></i>
        </div>

        <h1 class="font-['Plus_Jakarta_Sans'] text-xl font-extrabold text-slate-900">Portal Petugas Wisata</h1>
        <p class="text-xs text-slate-500 mt-1 mb-6">Masuk untuk mengelola kuota destinasi dan validasi E-Ticket QR.</p>

        @if($errors->any())
            <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-700 text-xs rounded-xl">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('petugas.login.submit') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-400 mb-1">Email Petugas</label>
                <input type="email" name="email" value="{{ old('email', 'petugas@wisatasulbar.id') }}" required
                       class="w-full px-3.5 py-2.5 border border-slate-200 rounded-xl text-xs font-medium focus:outline-none focus:border-sky-600">
            </div>
            <div>
                <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-400 mb-1">Kata Sandi</label>
                <input type="password" name="password" required placeholder="••••••••"
                       class="w-full px-3.5 py-2.5 border border-slate-200 rounded-xl text-xs font-medium focus:outline-none focus:border-sky-600">
            </div>
            <button type="submit"
                    class="w-full py-3 bg-sky-600 hover:bg-sky-700 text-white font-semibold rounded-full text-xs transition cursor-pointer">
                Masuk ke Portal Petugas
            </button>
        </form>

        <div class="mt-5 pt-4 border-t border-slate-100 text-center">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-1.5 text-xs text-slate-500 hover:text-sky-600">
                <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i>
                <span>Kembali ke Halaman Publik</span>
            </a>
        </div>
    </div>
    <script>lucide.createIcons();</script>
</body>
</html>
