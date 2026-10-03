<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Aqiqah Digital</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Quicksand', sans-serif; }
        .sidebar-link.active { background: rgba(255,255,255,0.15); }
    </style>
</head>
<body class="bg-gray-100 antialiased">

<div class="flex min-h-screen">
    <!-- Sidebar -->
    <aside class="w-64 bg-gradient-to-b from-blue-700 to-blue-900 text-white flex flex-col fixed h-full z-30 shadow-xl">
        <div class="p-6 border-b border-blue-600">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                    <i class="fas fa-baby text-white"></i>
                </div>
                <div>
                    <p class="font-bold text-sm">Admin Panel</p>
                    <p class="text-xs text-blue-200">Aqiqah Digital</p>
                </div>
            </div>
        </div>

        <nav class="flex-1 p-4 space-y-1">
            <a href="{{ route('admin.dashboard') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/15 transition-colors {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt w-5 text-center"></i>
                <span class="text-sm font-medium">Dashboard</span>
            </a>
            <a href="{{ route('admin.settings.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/15 transition-colors {{ request()->routeIs('admin.settings*') ? 'active' : '' }}">
                <i class="fas fa-cog w-5 text-center"></i>
                <span class="text-sm font-medium">Pengaturan Undangan</span>
            </a>
            <a href="{{ route('admin.guests.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/15 transition-colors {{ request()->routeIs('admin.guests*') ? 'active' : '' }}">
                <i class="fas fa-users w-5 text-center"></i>
                <span class="text-sm font-medium">Data Tamu</span>
            </a>
            <a href="{{ route('admin.gallery.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/15 transition-colors {{ request()->routeIs('admin.gallery*') ? 'active' : '' }}">
                <i class="fas fa-images w-5 text-center"></i>
                <span class="text-sm font-medium">Galeri Foto</span>
            </a>
            <a href="{{ route('admin.wishes.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/15 transition-colors {{ request()->routeIs('admin.wishes*') ? 'active' : '' }}">
                <i class="fas fa-heart w-5 text-center"></i>
                <span class="text-sm font-medium">Ucapan & Doa</span>
            </a>
            <a href="{{ route('admin.attendances.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/15 transition-colors {{ request()->routeIs('admin.attendances*') ? 'active' : '' }}">
                <i class="fas fa-check-circle w-5 text-center"></i>
                <span class="text-sm font-medium">Konfirmasi Hadir</span>
            </a>
        </nav>

        <div class="p-4 border-t border-blue-600">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                    <i class="fas fa-user text-xs"></i>
                </div>
                <div>
                    <p class="text-xs font-semibold">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-blue-200">{{ auth()->user()->email }}</p>
                </div>
            </div>
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center gap-2 px-4 py-2 bg-white/10 hover:bg-white/20 rounded-xl text-sm transition-colors">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 ml-64 flex flex-col min-h-screen">
        <!-- Top Bar -->
        <header class="bg-white shadow-sm px-6 py-4 flex items-center justify-between sticky top-0 z-20">
            <h1 class="text-lg font-bold text-gray-700">@yield('page-title', 'Dashboard')</h1>
            <a href="{{ route('frontend.show', 'tamu') }}" target="_blank" class="flex items-center gap-2 text-blue-500 hover:text-blue-700 text-sm font-medium transition-colors">
                <i class="fas fa-eye"></i> Lihat Undangan
            </a>
        </header>

        <!-- Page Content -->
        <main class="flex-1 p-6">
            @if(session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl flex items-center gap-2">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
            @endif

            @if($errors->any())
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl">
                <ul class="list-disc list-inside text-sm">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @yield('content')
        </main>

        <footer class="bg-white border-t px-6 py-3 text-center text-xs text-gray-400">
            &copy; 2026 Admin Panel - Aqiqah Digital
        </footer>
    </div>
</div>

</body>
</html>
