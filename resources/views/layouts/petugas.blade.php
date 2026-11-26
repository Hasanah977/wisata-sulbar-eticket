<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Portal Petugas — ExploreSulbar')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        display: ['Plus Jakarta Sans', 'sans-serif'],
                    },
                    colors: {
                        ice: '#F4F8FB',
                        ocean: {
                            50: '#EFF6FF',
                            100: '#E0F2FE',
                            600: '#0284C7',
                            700: '#0369A1',
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-ice text-slate-800 antialiased min-h-screen">
    <header class="bg-white border-b border-slate-200/80 sticky top-0 z-30">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 h-16 flex items-center justify-between">
            <div class="flex items-center gap-6">
                <a href="{{ route('petugas.dashboard') }}" class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg bg-ocean-600 text-white flex items-center justify-center">
                        <i data-lucide="shield-check" class="w-4 h-4"></i>
                    </div>
                    <span class="font-display font-bold text-sm text-slate-900">ExploreSulbar <span class="text-ocean-600">Ops</span></span>
                </a>

                <nav class="flex items-center gap-1 text-xs font-semibold">
                    <a href="{{ route('petugas.dashboard') }}"
                       class="px-3.5 py-2 rounded-full {{ request()->routeIs('petugas.dashboard') ? 'bg-ocean-50 text-ocean-700' : 'text-slate-500 hover:text-slate-900' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('petugas.destinations.index') }}"
                       class="px-3.5 py-2 rounded-full {{ request()->routeIs('petugas.destinations.*') ? 'bg-ocean-50 text-ocean-700' : 'text-slate-500 hover:text-slate-900' }}">
                        Destinasi
                    </a>
                    <a href="{{ route('petugas.scan.index') }}"
                       class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full bg-ocean-600 hover:bg-ocean-700 text-white ml-1 transition">
                        <i data-lucide="scan-line" class="w-3.5 h-3.5"></i>
                        <span>Scan QR</span>
                    </a>
                </nav>
            </div>

            <form action="{{ route('petugas.logout') }}" method="POST">
                @csrf
                <button type="submit" class="inline-flex items-center gap-1.5 text-xs font-medium text-slate-500 hover:text-red-600 cursor-pointer">
                    <i data-lucide="log-out" class="w-3.5 h-3.5"></i>
                    <span>Keluar</span>
                </button>
            </form>
        </div>
    </header>

    <main class="max-w-6xl mx-auto px-4 sm:px-6 py-8">
        @if(session('success'))
            <div class="mb-5 p-3.5 bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-medium rounded-2xl flex items-center gap-2">
                <i data-lucide="check-circle-2" class="w-4 h-4 shrink-0"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif
        @yield('content')
    </main>

    <script>lucide.createIcons();</script>
</body>
</html>
