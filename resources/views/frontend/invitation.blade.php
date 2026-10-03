<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Aqiqah {{ $settings->baby_nickname ?? 'Baby' }}</title>
    
    <!-- SEO & Open Graph -->
    <meta name="description" content="Undangan Aqiqah {{ $settings->baby_name ?? 'Baby' }}">
    <meta property="og:title" content="Aqiqah {{ $settings->baby_nickname ?? 'Baby' }}">
    <meta property="og:description" content="Undangan Aqiqah {{ $settings->baby_name ?? 'Baby' }}">
    @if($settings->cover_image)
    <meta property="og:image" content="{{ asset('storage/' . $settings->cover_image) }}">
    @endif

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&family=Great+Vibes&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --gold: #d4a853;
            --gold-light: #f0d68a;
            --gold-dark: #b8922e;
            --black: #0a0a0a;
            --black-light: #141414;
            --black-card: #1a1a1a;
            --black-border: #2a2a2a;
        }

        body {
            font-family: 'Quicksand', sans-serif;
            background-color: var(--black);
            color: #e5e5e5;
            overflow-x: hidden;
        }
        
        .font-script {
            font-family: 'Great Vibes', cursive;
        }

        .font-serif-elegant {
            font-family: 'Playfair Display', serif;
        }

        /* ===== ANIMATIONS ===== */
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-12px); }
            100% { transform: translateY(0px); }
        }
        .floating { animation: float 4s ease-in-out infinite; }
        .floating-delay { animation: float 5s ease-in-out infinite 1s; }

        @keyframes fadeOutUp {
            from { opacity: 1; transform: translateY(0); }
            to { opacity: 0; transform: translateY(-60px); visibility: hidden; }
        }
        .cover-leave { animation: fadeOutUp 1.2s cubic-bezier(0.4, 0, 0.2, 1) forwards; }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .fade-in-up { opacity: 0; }
        .fade-in-up.visible { animation: fadeInUp 0.8s ease forwards; }

        /* Gold glow pulse for decorative elements */
        @keyframes goldPulse {
            0%, 100% { opacity: 0.5; }
            50% { opacity: 0.8; }
        }

        /* ===== METEOR SHOWER ===== */
        @keyframes meteorFall {
            0% { transform: translateX(300px) translateY(-300px); opacity: 1; }
            100% { transform: translateX(-1500px) translateY(1500px); opacity: 0; }
        }
        .star-field {
            position: fixed;
            inset: 0;
            z-index: 5;
            pointer-events: none;
            overflow: hidden;
        }
        .meteor-star {
            position: absolute;
            color: var(--gold-light);
            /* 3D Gold effect using text-shadow */
            text-shadow: 
                1px 1px 0px var(--gold),
                2px 2px 0px var(--gold-dark),
                3px 3px 5px rgba(0,0,0,0.8),
                0 0 20px var(--gold-light);
            animation: meteorFall 4s linear infinite;
            will-change: transform, opacity;
        }
        .meteor-star::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 200px;
            height: 3px;
            background: linear-gradient(90deg, var(--gold-light), transparent);
            transform-origin: left center;
            transform: translateY(-50%) rotate(-45deg);
            z-index: -1;
            border-radius: 5px;
            filter: drop-shadow(0 0 8px var(--gold));
        }

        /* ===== 3D MOON & CLOUDS ===== */
        @keyframes moonCloudMove {
            0% { transform: translateX(120vw) translateY(5vh) scale(0.8); opacity: 0; }
            10% { opacity: 0.9; }
            80% { opacity: 0.9; }
            100% { transform: translateX(-50vw) translateY(-5vh) scale(1.1); opacity: 0; }
        }
        
        .moon-container {
            position: fixed;
            top: 10%;
            left: 0;
            width: 100%;
            z-index: 4;
            pointer-events: none;
            animation: moonCloudMove 45s linear infinite;
        }

        .moon-3d {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background: #f4f6f0;
            box-shadow: inset -12px -12px 18px rgba(0,0,0,0.4), 
                        inset 8px 8px 12px rgba(255,255,255,0.9),
                        0 0 25px rgba(252, 211, 77, 0.6);
            position: absolute;
            top: 0;
            left: 50%;
        }

        .moon-3d::before {
            content: '';
            position: absolute;
            top: 20px;
            left: 15px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: rgba(0,0,0,0.15);
            box-shadow: inset 2px 2px 6px rgba(0,0,0,0.2);
        }
        .moon-3d::after {
            content: '';
            position: absolute;
            bottom: 22px;
            right: 18px;
            width: 18px;
            height: 14px;
            border-radius: 50%;
            background: rgba(0,0,0,0.1);
            box-shadow: inset 2px 2px 5px rgba(0,0,0,0.2);
        }

        .cloud-3d {
            width: 140px;
            height: 45px;
            background: #e5e7eb;
            border-radius: 50px;
            position: absolute;
            opacity: 0.7;
            box-shadow: inset -5px -10px 15px rgba(0,0,0,0.15), 0 5px 15px rgba(0,0,0,0.1);
        }
        .cloud-3d.c1 { top: 30px; left: calc(50% - 60px); transform: scale(0.9); z-index: 2; }
        .cloud-3d.c2 { top: 10px; left: calc(50% + 40px); transform: scale(0.7); opacity: 0.5; z-index: 1; }
        
        .cloud-3d::before, .cloud-3d::after {
            content: '';
            position: absolute;
            background: #e5e7eb;
            border-radius: 50%;
            box-shadow: inset -5px -5px 10px rgba(0,0,0,0.05);
        }
        .cloud-3d::before {
            width: 60px;
            height: 60px;
            top: -30px;
            left: 20px;
        }
        .cloud-3d::after {
            width: 80px;
            height: 80px;
            top: -45px;
            right: 20px;
        }

        /* ===== DARK CLOUDS ===== */
        @keyframes cloudDrift {
            0% { transform: translateX(-10%); }
            50% { transform: translateX(10%); }
            100% { transform: translateX(-10%); }
        }
        .dark-cloud {
            position: absolute;
            z-index: 1;
            opacity: 0.12;
            filter: blur(2px);
            pointer-events: none;
            will-change: transform;
        }
        .dark-cloud svg {
            fill: #3a3a3a;
            filter: drop-shadow(0 0 15px rgba(212, 168, 83, 0.08));
        }

        /* ===== COVER SCREEN ===== */
        #cover-screen {
            position: fixed;
            inset: 0;
            z-index: 50;
            background: radial-gradient(ellipse at center top, #1a1610 0%, #0a0a0a 60%, #050505 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 1.5rem;
            transition: all 1s ease;
        }

        /* ===== MAIN CONTENT ===== */
        #main-content {
            display: none;
            opacity: 0;
            transition: opacity 1s ease;
        }

        .glass-card {
            background: rgba(26, 26, 26, 0.85);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(212, 168, 83, 0.15);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4);
        }

        /* ===== BOTTOM NAV ===== */
        .bottom-nav {
            background: rgba(10, 10, 10, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 -4px 20px rgba(0,0,0,0.3);
            border-top: 1px solid rgba(212, 168, 83, 0.15);
        }

        /* ===== SCROLLBAR ===== */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: var(--black); }
        ::-webkit-scrollbar-thumb { background: var(--gold-dark); border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: var(--gold); }

        /* ===== GOLD DIVIDER ===== */
        .gold-divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--gold), transparent);
            margin: 1rem auto;
            max-width: 200px;
        }

        /* ===== REDUCED MOTION ===== */
        @media (prefers-reduced-motion: reduce) {
            .floating, .floating-delay, .meteor, .dark-cloud, .moon-container { animation: none !important; }
            .cover-leave { animation-duration: 0.3s !important; }
            .fade-in-up.visible { animation-duration: 0.3s !important; }
        }
    </style>
</head>
<body class="antialiased">

    <!-- Audio Player (uses file from admin settings, or placeholder) -->
    <audio id="bgMusic" loop preload="auto">
        @if(isset($settings) && $settings->music_file)
        <source src="{{ asset('storage/' . $settings->music_file) }}" type="audio/mpeg">
        @else
        <source src="https://server8.mp3quran.net/afs/005.mp3" type="audio/mpeg">
        @endif
    </audio>
    <button id="musicToggle" class="fixed top-4 right-4 z-40 w-11 h-11 rounded-full hidden items-center justify-center transition-all duration-300 shadow-lg" style="background: rgba(26,26,26,0.85); border: 1px solid rgba(212,168,83,0.3);">
        <i class="fas fa-compact-disc text-lg" id="musicIcon" style="color: var(--gold);"></i>
    </button>

    <!-- ===== METEOR SHOWER & MOON CONTAINER (initially hidden, shown after "Buka Undangan") ===== -->
    <div id="starField" class="star-field" style="display:none;">
        <div class="moon-container">
            <div class="moon-3d"></div>
            <div class="cloud-3d c1"></div>
            <div class="cloud-3d c2"></div>
        </div>
    </div>

    <!-- ===== COVER SCREEN ===== -->
    <div id="cover-screen">
        <!-- Dark clouds on cover -->
        <div class="dark-cloud" style="top:5%; left:-5%; animation: cloudDrift 30s ease-in-out infinite;">
            <svg width="320" height="120" viewBox="0 0 320 120"><ellipse cx="160" cy="70" rx="160" ry="55"/><ellipse cx="100" cy="50" rx="80" ry="40"/><ellipse cx="230" cy="55" rx="90" ry="45"/></svg>
        </div>
        <div class="dark-cloud" style="bottom:8%; right:-8%; animation: cloudDrift 25s ease-in-out infinite reverse;">
            <svg width="280" height="100" viewBox="0 0 280 100"><ellipse cx="140" cy="60" rx="140" ry="50"/><ellipse cx="80" cy="40" rx="70" ry="35"/></svg>
        </div>

        <div class="glass-card p-8 rounded-3xl max-w-sm w-full mx-auto flex flex-col items-center relative z-10">
            <!-- Gold ornament top -->
            <div class="gold-divider mb-3" style="max-width:120px;"></div>
            
            <span class="text-xs tracking-[0.3em] uppercase font-semibold mb-2" style="color: var(--gold);">The Aqiqah Ceremony</span>
            
            <p class="text-xs text-gray-400 mb-4 italic">Assalamu'alaikum Warahmatullahi Wabarakatuh</p>
            
            <h1 class="text-4xl font-script mb-2" style="color: var(--gold-light);">Syukuran Aqiqah</h1>
            
            @if($settings->cover_image)
            <img src="{{ asset('storage/' . $settings->cover_image) }}" alt="Cover" class="w-28 h-28 object-cover rounded-full my-4 floating" style="border: 3px solid var(--gold); box-shadow: 0 0 25px rgba(212,168,83,0.2);">
            @else
            <div class="w-28 h-28 rounded-full flex items-center justify-center my-4 floating" style="border: 3px solid var(--gold); background: rgba(212,168,83,0.08);">
                <i class="fas fa-baby text-4xl" style="color: var(--gold);"></i>
            </div>
            @endif

            <h2 class="text-2xl font-bold text-white mb-1 font-serif-elegant">{{ $settings->baby_name ?? '[Nama Bayi]' }}</h2>
            <p class="text-xs text-gray-400 mb-5">Putra dari<br><span class="font-semibold text-gray-300">{{ $settings->father_name ?? '[Nama Ayah]' }} & {{ $settings->mother_name ?? '[Nama Ibu]' }}</span></p>

            <div class="gold-divider mb-4"></div>

            <div class="w-full pt-2 mb-5">
                <p class="text-xs text-gray-500">Dear,</p>
                <p class="text-lg font-bold my-1" style="color: var(--gold-light);">{{ $guestName }}</p>
                <p class="text-xs text-gray-500">Anda diundang untuk menghadiri acara aqiqah kami.</p>
            </div>

            <button onclick="openInvitation()" class="font-semibold py-3 px-8 rounded-full shadow-lg transition-all transform hover:scale-105 active:scale-95 flex items-center gap-2 text-sm" style="background: linear-gradient(135deg, var(--gold-dark), var(--gold)); color: #0a0a0a; box-shadow: 0 4px 20px rgba(212,168,83,0.3);">
                <i class="fas fa-envelope-open-text"></i> BUKA UNDANGAN
            </button>

            <div class="gold-divider mt-4" style="max-width:120px;"></div>
        </div>
    </div>

    <!-- ===== MAIN CONTENT ===== -->
    <main id="main-content" class="pb-24 relative">
        <!-- Dark clouds in main content -->
        <div class="dark-cloud" style="top:8%; right:-10%; animation: cloudDrift 35s ease-in-out infinite;">
            <svg width="350" height="130" viewBox="0 0 350 130"><ellipse cx="175" cy="75" rx="175" ry="60"/><ellipse cx="100" cy="50" rx="90" ry="40"/><ellipse cx="260" cy="55" rx="90" ry="50"/></svg>
        </div>

        <!-- Hero Section -->
        <section id="home" class="min-h-screen relative flex flex-col items-center justify-center text-center p-6" style="background: radial-gradient(ellipse at center, #111 0%, #0a0a0a 70%);">
            <div class="fade-in-up relative z-10">
                <h3 class="text-xl mb-4 text-gray-300" style="font-family: 'Playfair Display', serif;">بِسْمِ اللَّهِ الرَّحْمَنِ الرَّحِيمِ</h3>
                
                <div class="gold-divider mb-4"></div>
                
                <h2 class="text-4xl font-script mb-4" style="color: var(--gold-light);">Syukuran Aqiqah</h2>
                <p class="text-gray-400 max-w-md mx-auto mb-6 text-sm">Alhamdulillah, telah lahir putra tercinta kami</p>
                
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-2 font-serif-elegant">{{ $settings->baby_name ?? '[Nama Bayi]' }}</h1>
                <p class="font-medium mb-8 text-sm" style="color: var(--gold);">{{ $settings->birth_date ? \Carbon\Carbon::parse($settings->birth_date)->translatedFormat('d F Y') : '[Tanggal Lahir]' }}</p>
                
                <p class="text-sm text-gray-500">Putra dari</p>
                <p class="text-lg font-semibold text-gray-200">{{ $settings->father_name ?? '[Nama Ayah]' }} & {{ $settings->mother_name ?? '[Nama Ibu]' }}</p>
                
                <div class="gold-divider mt-6"></div>
            </div>
            
            <div class="absolute bottom-10 animate-bounce">
                <i class="fas fa-chevron-down text-2xl" style="color: var(--gold-dark);"></i>
            </div>
        </section>

        <!-- About Baby Section -->
        <section id="baby" class="py-20 px-6 relative" style="background: var(--black-light);">
            <div class="max-w-4xl mx-auto text-center fade-in-up">
                <h2 class="text-4xl font-script mb-2" style="color: var(--gold-light);">Our Little Prince</h2>
                <div class="gold-divider mb-10"></div>
                
                <div class="flex flex-col md:flex-row items-center justify-center gap-10">
                    <div class="relative">
                        @if($settings->baby_photo)
                        <img src="{{ asset('storage/' . $settings->baby_photo) }}" alt="Baby" class="w-48 h-48 md:w-56 md:h-56 object-cover rounded-full shadow-xl floating" style="border: 4px solid var(--gold); box-shadow: 0 0 30px rgba(212,168,83,0.15);">
                        @else
                        <div class="w-48 h-48 md:w-56 md:h-56 rounded-full flex items-center justify-center shadow-xl floating" style="border: 4px solid var(--gold); background: rgba(212,168,83,0.05);">
                            <i class="fas fa-baby text-6xl" style="color: var(--gold);"></i>
                        </div>
                        @endif
                        <div class="absolute -bottom-3 -right-3 p-2 rounded-full shadow-lg text-2xl" style="background: var(--black-card); border: 1px solid var(--gold-dark); color: var(--gold);">
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    
                    <div class="glass-card p-6 rounded-2xl text-left flex-1 w-full md:w-auto">
                        <ul class="space-y-4">
                            <li class="flex pb-3" style="border-bottom: 1px solid var(--black-border);">
                                <span class="w-1/3 text-gray-500 text-sm">Nama Lengkap</span>
                                <span class="w-2/3 font-semibold text-white">{{ $settings->baby_name ?? '-' }}</span>
                            </li>
                            <li class="flex pb-3" style="border-bottom: 1px solid var(--black-border);">
                                <span class="w-1/3 text-gray-500 text-sm">Panggilan</span>
                                <span class="w-2/3 font-semibold" style="color: var(--gold-light);">{{ $settings->baby_nickname ?? '-' }}</span>
                            </li>
                            <li class="flex pb-3" style="border-bottom: 1px solid var(--black-border);">
                                <span class="w-1/3 text-gray-500 text-sm">Lahir</span>
                                <span class="w-2/3 font-semibold text-white">{{ $settings->birth_place ?? '-' }}, {{ $settings->birth_date ? \Carbon\Carbon::parse($settings->birth_date)->translatedFormat('d F Y') : '-' }}</span>
                            </li>
                            <li class="flex pb-3" style="border-bottom: 1px solid var(--black-border);">
                                <span class="w-1/3 text-gray-500 text-sm">Anak Ke-</span>
                                <span class="w-2/3 font-semibold text-white">{{ $settings->birth_order ?? '-' }}</span>
                            </li>
                            <li class="flex">
                                <span class="w-1/3 text-gray-500 text-sm">Berat/Panjang</span>
                                <span class="w-2/3 font-semibold text-white">{{ $settings->weight ?? '-' }} kg / {{ $settings->height ?? '-' }} cm</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- Event Section -->
        <section id="event" class="py-20 px-6 relative" style="background: var(--black);">
            <!-- Cloud decoration -->
            <div class="dark-cloud" style="top:0; left:-8%; animation: cloudDrift 28s ease-in-out infinite reverse;">
                <svg width="300" height="110" viewBox="0 0 300 110"><ellipse cx="150" cy="65" rx="150" ry="50"/><ellipse cx="80" cy="40" rx="70" ry="30"/></svg>
            </div>

            <div class="max-w-lg mx-auto text-center fade-in-up relative z-10">
                <h2 class="text-4xl font-script mb-2" style="color: var(--gold-light);">Waktu & Tempat</h2>
                <div class="gold-divider mb-10"></div>
                
                <div class="glass-card rounded-3xl p-8 shadow-xl relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-full h-1" style="background: linear-gradient(90deg, transparent, var(--gold), transparent);"></div>
                    
                    <h3 class="text-lg font-bold text-white mb-6 uppercase tracking-widest font-serif-elegant">Acara Aqiqah</h3>
                    
                    <div class="space-y-6">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-full flex items-center justify-center shrink-0" style="background: rgba(212,168,83,0.1); border: 1px solid rgba(212,168,83,0.2);">
                                <i class="fas fa-calendar-alt text-xl" style="color: var(--gold);"></i>
                            </div>
                            <div class="text-left">
                                <p class="text-xs text-gray-500 mb-1">Hari & Tanggal</p>
                                <p class="font-semibold text-white">{{ $settings->event_date ? \Carbon\Carbon::parse($settings->event_date)->translatedFormat('l, d F Y') : '-' }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-full flex items-center justify-center shrink-0" style="background: rgba(212,168,83,0.1); border: 1px solid rgba(212,168,83,0.2);">
                                <i class="fas fa-clock text-xl" style="color: var(--gold);"></i>
                            </div>
                            <div class="text-left">
                                <p class="text-xs text-gray-500 mb-1">Waktu</p>
                                <p class="font-semibold text-white">{{ $settings->event_time ? \Carbon\Carbon::parse($settings->event_time)->format('H:i') : '-' }} WIB - Selesai</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-full flex items-center justify-center shrink-0" style="background: rgba(212,168,83,0.1); border: 1px solid rgba(212,168,83,0.2);">
                                <i class="fas fa-map-marker-alt text-xl" style="color: var(--gold);"></i>
                            </div>
                            <div class="text-left">
                                <p class="text-xs text-gray-500 mb-1">Lokasi</p>
                                <p class="font-semibold text-white">{{ $settings->venue ?? '-' }}</p>
                                <p class="text-sm text-gray-400 mt-1">{{ $settings->address ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                    
                    @if($settings->maps_url)
                    <a href="{{ $settings->maps_url }}" target="_blank" class="mt-8 inline-flex items-center justify-center w-full font-semibold py-3 px-6 rounded-xl shadow-md transition-all hover:scale-[1.02] active:scale-[0.98] text-sm" style="background: linear-gradient(135deg, var(--gold-dark), var(--gold)); color: #0a0a0a;">
                        <i class="fas fa-map-marked-alt mr-2"></i> LIHAT LOKASI
                    </a>
                    @endif
                </div>

                <!-- Countdown -->
                <div class="mt-12 glass-card p-6 rounded-2xl">
                    <h4 class="text-xs uppercase tracking-[0.2em] font-semibold mb-5" style="color: var(--gold);">Menuju Hari Bahagia</h4>
                    <div id="countdown-container" class="flex justify-center gap-3 md:gap-4">
                        <div class="flex flex-col items-center">
                            <span id="days" class="text-2xl md:text-3xl font-bold text-white w-14 h-14 md:w-16 md:h-16 flex items-center justify-center rounded-xl" style="background: var(--black-card); border: 1px solid var(--black-border);">00</span>
                            <span class="text-xs text-gray-500 mt-2">Hari</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <span id="hours" class="text-2xl md:text-3xl font-bold text-white w-14 h-14 md:w-16 md:h-16 flex items-center justify-center rounded-xl" style="background: var(--black-card); border: 1px solid var(--black-border);">00</span>
                            <span class="text-xs text-gray-500 mt-2">Jam</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <span id="minutes" class="text-2xl md:text-3xl font-bold text-white w-14 h-14 md:w-16 md:h-16 flex items-center justify-center rounded-xl" style="background: var(--black-card); border: 1px solid var(--black-border);">00</span>
                            <span class="text-xs text-gray-500 mt-2">Menit</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <span id="seconds" class="text-2xl md:text-3xl font-bold text-white w-14 h-14 md:w-16 md:h-16 flex items-center justify-center rounded-xl" style="background: var(--black-card); border: 1px solid var(--black-border);">00</span>
                            <span class="text-xs text-gray-500 mt-2">Detik</span>
                        </div>
                    </div>
                    <div id="countdown-expired" class="hidden mt-4 font-semibold" style="color: var(--gold);">
                        Acara telah berlangsung ❤️
                    </div>
                </div>
            </div>
        </section>

        <!-- Gallery Section -->
        <section id="gallery" class="py-20 px-6" style="background: var(--black-light);">
            <div class="max-w-5xl mx-auto fade-in-up">
                <div class="text-center mb-10">
                    <h2 class="text-4xl font-script mb-2" style="color: var(--gold-light);">Little Moments</h2>
                    <div class="gold-divider mb-3"></div>
                    <p class="text-gray-500 text-sm">Momen indah si kecil</p>
                </div>
                
                @if($galleries->count() > 0)
                <div class="grid grid-cols-2 md:grid-cols-3 gap-3 md:gap-4">
                    @foreach($galleries as $photo)
                    <div class="aspect-square overflow-hidden rounded-xl relative group cursor-pointer" style="border: 2px solid var(--black-border);" onclick="openLightbox('{{ asset('storage/' . $photo->image) }}')">
                        <img src="{{ asset('storage/' . $photo->image) }}" alt="Gallery" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" loading="lazy">
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                            <i class="fas fa-search-plus text-white text-2xl"></i>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8 max-w-4xl mx-auto mt-4">
                    <!-- Bingkai 1 -->
                    <div class="bg-white p-3 shadow-2xl rounded-sm transform rotate-[-3deg] transition hover:rotate-0" style="border: 1px solid #ddd; box-shadow: 0 10px 25px rgba(0,0,0,0.5);">
                        <img src="https://images.unsplash.com/photo-1519689680058-324335c77eba?w=400&q=80" alt="Baby 1" class="w-full aspect-square object-cover" loading="lazy">
                    </div>
                    <!-- Bingkai 2 -->
                    <div class="bg-white p-3 shadow-2xl rounded-sm transform rotate-[4deg] transition hover:rotate-0" style="border: 1px solid #ddd; box-shadow: 0 10px 25px rgba(0,0,0,0.5);">
                        <img src="https://images.unsplash.com/photo-1522771930-78848d9293e8?w=400&q=80" alt="Baby 2" class="w-full aspect-square object-cover" loading="lazy">
                    </div>
                    <!-- Bingkai 3 -->
                    <div class="bg-white p-3 shadow-2xl rounded-sm transform rotate-[-2deg] transition hover:rotate-0" style="border: 1px solid #ddd; box-shadow: 0 10px 25px rgba(0,0,0,0.5);">
                        <img src="https://images.unsplash.com/photo-1544126592-807ade215a0b?w=400&q=80" alt="Baby 3" class="w-full aspect-square object-cover" loading="lazy">
                    </div>
                </div>
                @endif
            </div>
        </section>

        <!-- Lightbox -->
        <div id="lightbox" class="fixed inset-0 z-50 bg-black/95 hidden flex items-center justify-center p-4 opacity-0 transition-opacity duration-300">
            <button onclick="closeLightbox()" class="absolute top-6 right-6 text-white text-3xl hover:text-gray-300 z-10">&times;</button>
            <img id="lightbox-img" src="" alt="Fullscreen" class="max-w-full max-h-full rounded-lg shadow-2xl transform scale-95 transition-transform duration-300">
        </div>

        <!-- COMBINED: Konfirmasi Kehadiran + Ucapan & Doa -->
        <section id="wishes" class="py-20 px-6 relative" style="background: var(--black);">
            <div class="max-w-2xl mx-auto fade-in-up">
                <div class="text-center mb-10">
                    <h2 class="text-4xl font-script mb-2" style="color: var(--gold-light);">Konfirmasi Kehadiran & Ucapan</h2>
                    <div class="gold-divider mb-3"></div>
                    <p class="text-gray-500 text-sm">Konfirmasikan kehadiran Anda dan sampaikan doa terbaik untuk si kecil</p>
                </div>
                
                <!-- AJAX Form -->
                <div id="rsvp-form-container" class="glass-card p-6 md:p-8 rounded-2xl mb-8">
                    <form id="rsvpWishForm">
                        <div class="mb-5">
                            <label class="block text-sm font-medium text-gray-300 mb-2">Nama <span class="text-red-400">*</span></label>
                            <input type="text" name="guest_name" id="inp_name" value="{{ $guestName !== 'Tamu Undangan' ? $guestName : '' }}" required class="w-full px-4 py-3 rounded-xl focus:outline-none transition-colors text-white text-sm" style="background: var(--black-card); border: 1px solid var(--black-border);" placeholder="Masukkan nama Anda">
                            <p id="err_name" class="text-red-400 text-xs mt-1 hidden"></p>
                        </div>

                        <div class="mb-5">
                            <label class="block text-sm font-medium text-gray-300 mb-2">Konfirmasi Kehadiran <span class="text-red-400">*</span></label>
                            <select name="status" id="inp_status" required class="w-full px-4 py-3 rounded-xl focus:outline-none transition-colors text-white text-sm" style="background: var(--black-card); border: 1px solid var(--black-border);">
                                <option value="" disabled selected>-- Pilih Status --</option>
                                <option value="Hadir">✅ Hadir</option>
                                <option value="Tidak Hadir">❌ Tidak Hadir</option>
                                <option value="Masih Ragu">🤔 Masih Ragu</option>
                            </select>
                            <p id="err_status" class="text-red-400 text-xs mt-1 hidden"></p>
                        </div>

                        <div class="mb-5">
                            <label class="block text-sm font-medium text-gray-300 mb-2">Jumlah Tamu <span class="text-red-400">*</span></label>
                            <input type="number" name="people_count" id="inp_people" min="1" value="1" required class="w-full px-4 py-3 rounded-xl focus:outline-none transition-colors text-white text-sm" style="background: var(--black-card); border: 1px solid var(--black-border);">
                            <p id="err_people" class="text-red-400 text-xs mt-1 hidden"></p>
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-300 mb-2">Ucapan & Doa <span class="text-gray-600 text-xs">(Opsional)</span></label>
                            <textarea name="message" id="inp_message" rows="3" class="w-full px-4 py-3 rounded-xl focus:outline-none transition-colors text-white text-sm" style="background: var(--black-card); border: 1px solid var(--black-border);" placeholder="Tulis doa untuk si kecil..."></textarea>
                        </div>

                        <!-- General error message -->
                        <p id="form-error" class="text-red-400 text-sm mb-4 hidden text-center"></p>

                        <button type="submit" id="btnSubmit" class="w-full font-semibold py-3 rounded-xl shadow-lg transition-all transform hover:scale-[1.02] active:scale-[0.98] flex items-center justify-center gap-2 text-sm" style="background: linear-gradient(135deg, var(--gold-dark), var(--gold)); color: #0a0a0a;">
                            <i class="fas fa-paper-plane"></i> Kirim Konfirmasi
                        </button>
                    </form>
                </div>

                <!-- Success notification (shown after AJAX submit) -->
                <div id="rsvp-success" class="glass-card p-8 rounded-2xl text-center hidden" style="border-color: rgba(212,168,83,0.3);">
                    <div class="text-5xl mb-4">✨</div>
                    <h3 class="text-xl font-bold text-white mb-2">Terima Kasih!</h3>
                    <p class="text-gray-400 text-sm" id="success-message-text">Konfirmasi kehadiran dan ucapan Anda telah berhasil dikirim.</p>
                    <div class="gold-divider mt-4"></div>
                </div>

                <!-- Wishes List -->
                <div class="mt-8">
                    <h3 class="text-lg font-semibold text-white mb-4 text-center">Ucapan & Doa</h3>
                    <div class="space-y-3 max-h-80 overflow-y-auto pr-1" id="wishes-list">
                        @forelse($wishes as $wish)
                        <div class="p-4 rounded-xl" style="background: var(--black-card); border: 1px solid var(--black-border);">
                            <p class="font-bold text-sm mb-1" style="color: var(--gold-light);">{{ $wish->guest_name }} <span class="text-xs text-gray-600 font-normal ml-2">{{ $wish->created_at->diffForHumans() }}</span></p>
                            <p class="text-gray-400 text-sm">{{ $wish->message }}</p>
                        </div>
                        @empty
                        <p class="text-center text-gray-600 text-sm py-4" id="no-wishes-text">Belum ada ucapan.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer / Penutup -->
        <footer class="py-16 px-6 text-center relative" style="background: var(--black-light);">
            <div class="max-w-md mx-auto fade-in-up">
                <div class="gold-divider mb-6"></div>
                <p class="text-gray-400 mb-6 leading-relaxed text-sm">
                    Merupakan suatu kebahagiaan bagi kami apabila Bapak/Ibu/Saudara/i berkenan hadir dan memberikan doa untuk putra kecil kami.<br><br>
                    Terima kasih atas perhatian dan doanya.<br>
                    <span class="italic text-gray-500">Assalamu'alaikum Warahmatullahi Wabarakatuh</span>
                </p>
                
                <h3 class="text-2xl font-bold text-white mb-1 font-serif-elegant">{{ $settings->baby_name ?? '[Nama Bayi]' }}</h3>
                <p class="font-medium text-sm" style="color: var(--gold);">{{ $settings->father_name ?? 'Ayah' }} & {{ $settings->mother_name ?? 'Ibu' }}</p>
                
                <div class="gold-divider mt-6 mb-6"></div>
                
                <div class="text-xs text-white">
                    &copy; 2026 Dicky Developed.<br>
                    Hak Cipta Dilindungi oleh Undang-Undang
                </div>
            </div>
        </footer>
    </main>

    <!-- Bottom Navigation (Mobile) -->
    <nav id="bottom-nav" class="bottom-nav fixed bottom-0 left-0 right-0 z-40 hidden transition-transform translate-y-full">
        <ul class="flex justify-around items-center p-3">
            <li><a href="#home" class="flex flex-col items-center text-gray-500 hover:text-yellow-500 transition-colors"><i class="fas fa-home text-lg mb-1"></i><span class="text-[10px] uppercase font-bold">Home</span></a></li>
            <li><a href="#baby" class="flex flex-col items-center text-gray-500 hover:text-yellow-500 transition-colors"><i class="fas fa-baby text-lg mb-1"></i><span class="text-[10px] uppercase font-bold">Bayi</span></a></li>
            <li><a href="#event" class="flex flex-col items-center text-gray-500 hover:text-yellow-500 transition-colors"><i class="fas fa-calendar-alt text-lg mb-1"></i><span class="text-[10px] uppercase font-bold">Acara</span></a></li>
            <li><a href="#gallery" class="flex flex-col items-center text-gray-500 hover:text-yellow-500 transition-colors"><i class="fas fa-images text-lg mb-1"></i><span class="text-[10px] uppercase font-bold">Galeri</span></a></li>
            <li><a href="#wishes" class="flex flex-col items-center text-gray-500 hover:text-yellow-500 transition-colors"><i class="fas fa-envelope text-lg mb-1"></i><span class="text-[10px] uppercase font-bold">Ucapan</span></a></li>
        </ul>
    </nav>

    <!-- ===== JAVASCRIPT ===== -->
    <script>
        /* ==============================
           METEOR FIELD GENERATOR
        ============================== */
        function createStars() {
            const field = document.getElementById('starField');
            const meteorCount = 15; // Adjust for performance
            
            for (let i = 0; i < meteorCount; i++) {
                const meteor = document.createElement('i');
                meteor.className = `fas fa-star meteor-star`;
                
                const top = Math.random() * 50; 
                const left = Math.random() * 120; // Allow starting further right
                const delay = Math.random() * 8;
                const duration = 4 + Math.random() * 3;
                const size = 15 + Math.random() * 20; // 15px to 35px size
                
                meteor.style.cssText = `
                    top: -${top}vh;
                    left: ${left}%;
                    font-size: ${size}px;
                    animation-delay: ${delay}s;
                    animation-duration: ${duration}s;
                `;
                field.appendChild(meteor);
            }
        }

        /* ==============================
           OPEN INVITATION
        ============================== */
        function openInvitation() {
            const cover = document.getElementById('cover-screen');
            const main = document.getElementById('main-content');
            const nav = document.getElementById('bottom-nav');
            const audio = document.getElementById('bgMusic');
            const musicBtn = document.getElementById('musicToggle');
            const starField = document.getElementById('starField');

            // Start stars
            starField.style.display = 'block';
            createStars();

            // Play music
            if (audio) {
                audio.play().then(() => {
                    musicBtn.classList.remove('hidden');
                    musicBtn.classList.add('flex');
                    document.getElementById('musicIcon').classList.add('animate-spin');
                }).catch(() => {
                    // Autoplay blocked - show play button
                    musicBtn.classList.remove('hidden');
                    musicBtn.classList.add('flex');
                    document.getElementById('musicIcon').classList.remove('animate-spin');
                    document.getElementById('musicIcon').classList.remove('fa-compact-disc');
                    document.getElementById('musicIcon').classList.add('fa-play');
                });
            }

            // Animate cover out
            cover.classList.add('cover-leave');
            
            setTimeout(() => {
                cover.style.display = 'none';
                main.style.display = 'block';
                void main.offsetWidth; // trigger reflow
                main.style.opacity = '1';
                
                // Show nav
                nav.classList.remove('hidden');
                setTimeout(() => {
                    nav.classList.remove('translate-y-full');
                }, 100);

                initScrollAnimations();
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }, 1200);
        }

        /* ==============================
           MUSIC TOGGLE
        ============================== */
        const musicToggleBtn = document.getElementById('musicToggle');
        if (musicToggleBtn) {
            musicToggleBtn.addEventListener('click', function() {
                const audio = document.getElementById('bgMusic');
                const icon = document.getElementById('musicIcon');
                
                if (audio.paused) {
                    audio.play().then(() => {
                        icon.className = 'fas fa-compact-disc text-lg animate-spin';
                        icon.style.color = 'var(--gold)';
                    });
                } else {
                    audio.pause();
                    icon.className = 'fas fa-pause text-lg';
                    icon.style.color = '#666';
                }
            });
        }

        /* ==============================
           SCROLL ANIMATIONS
        ============================== */
        function initScrollAnimations() {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, { threshold: 0.1 });

            document.querySelectorAll('.fade-in-up').forEach(el => observer.observe(el));
        }

        /* ==============================
           COUNTDOWN
        ============================== */
        @if($settings->countdown_datetime)
        const targetDate = new Date("{{ \Carbon\Carbon::parse($settings->countdown_datetime)->format('Y-m-d\TH:i:s') }}").getTime();
        
        const countdownInterval = setInterval(function() {
            const now = new Date().getTime();
            const distance = targetDate - now;

            if (distance < 0) {
                clearInterval(countdownInterval);
                document.getElementById("countdown-container").style.display = "none";
                document.getElementById("countdown-expired").classList.remove("hidden");
                return;
            }

            document.getElementById("days").innerText = Math.floor(distance / (1000*60*60*24)).toString().padStart(2,'0');
            document.getElementById("hours").innerText = Math.floor((distance % (1000*60*60*24)) / (1000*60*60)).toString().padStart(2,'0');
            document.getElementById("minutes").innerText = Math.floor((distance % (1000*60*60)) / (1000*60)).toString().padStart(2,'0');
            document.getElementById("seconds").innerText = Math.floor((distance % (1000*60)) / 1000).toString().padStart(2,'0');
        }, 1000);
        @endif

        /* ==============================
           LIGHTBOX
        ============================== */
        function openLightbox(src) {
            const lb = document.getElementById('lightbox');
            const img = document.getElementById('lightbox-img');
            img.src = src;
            lb.classList.remove('hidden');
            setTimeout(() => {
                lb.classList.remove('opacity-0');
                img.classList.remove('scale-95');
                img.classList.add('scale-100');
            }, 10);
        }

        function closeLightbox() {
            const lb = document.getElementById('lightbox');
            const img = document.getElementById('lightbox-img');
            lb.classList.add('opacity-0');
            img.classList.remove('scale-100');
            img.classList.add('scale-95');
            setTimeout(() => lb.classList.add('hidden'), 300);
        }

        /* ==============================
           AJAX RSVP + WISH FORM
        ============================== */
        document.getElementById('rsvpWishForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            // Reset errors
            ['err_name','err_status','err_people','form-error'].forEach(id => {
                document.getElementById(id).classList.add('hidden');
                document.getElementById(id).textContent = '';
            });

            const name = document.getElementById('inp_name').value.trim();
            const status = document.getElementById('inp_status').value;
            const people = document.getElementById('inp_people').value;
            const message = document.getElementById('inp_message').value.trim();

            // Client-side validation
            let hasError = false;
            if (!name) {
                document.getElementById('err_name').textContent = 'Mohon lengkapi nama Anda.';
                document.getElementById('err_name').classList.remove('hidden');
                hasError = true;
            }
            if (!status) {
                document.getElementById('err_status').textContent = 'Silakan pilih konfirmasi kehadiran terlebih dahulu.';
                document.getElementById('err_status').classList.remove('hidden');
                hasError = true;
            }
            if (!people || parseInt(people) < 1) {
                document.getElementById('err_people').textContent = 'Jumlah tamu harus berupa angka yang valid.';
                document.getElementById('err_people').classList.remove('hidden');
                hasError = true;
            }
            if (hasError) return;

            // Disable button
            const btn = document.getElementById('btnSubmit');
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengirim...';

            try {
                const slug = '{{ request()->route("slug") }}';
                const response = await fetch(`/undangan/${slug}/rsvp-wish`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({
                        guest_name: name,
                        status: status,
                        people_count: parseInt(people),
                        message: message || null,
                    }),
                });

                const data = await response.json();

                if (response.ok && data.success) {
                    // Show success, hide form
                    document.getElementById('rsvp-form-container').style.display = 'none';
                    document.getElementById('rsvp-success').classList.remove('hidden');
                    document.getElementById('success-message-text').textContent = data.message;

                    // Append wish to list if message was provided
                    if (message) {
                        const noWishes = document.getElementById('no-wishes-text');
                        if (noWishes) noWishes.remove();
                        
                        const list = document.getElementById('wishes-list');
                        const div = document.createElement('div');
                        div.className = 'p-4 rounded-xl';
                        div.style.cssText = 'background: var(--black-card); border: 1px solid var(--black-border);';
                        div.innerHTML = `
                            <p class="font-bold text-sm mb-1" style="color: var(--gold-light);">${name} <span class="text-xs text-gray-600 font-normal ml-2">baru saja</span></p>
                            <p class="text-gray-400 text-sm">${message}</p>
                        `;
                        list.prepend(div);
                    }
                } else {
                    // Server validation errors
                    if (data.errors) {
                        if (data.errors.guest_name) { document.getElementById('err_name').textContent = data.errors.guest_name[0]; document.getElementById('err_name').classList.remove('hidden'); }
                        if (data.errors.status) { document.getElementById('err_status').textContent = data.errors.status[0]; document.getElementById('err_status').classList.remove('hidden'); }
                        if (data.errors.people_count) { document.getElementById('err_people').textContent = data.errors.people_count[0]; document.getElementById('err_people').classList.remove('hidden'); }
                    } else {
                        document.getElementById('form-error').textContent = data.message || 'Terjadi kesalahan. Silakan coba lagi.';
                        document.getElementById('form-error').classList.remove('hidden');
                    }
                    btn.disabled = false;
                    btn.innerHTML = '<i class="fas fa-paper-plane"></i> Kirim Konfirmasi';
                }
            } catch (err) {
                document.getElementById('form-error').textContent = 'Terjadi kesalahan koneksi. Silakan coba lagi.';
                document.getElementById('form-error').classList.remove('hidden');
                btn.disabled = false;
                btn.innerHTML = '<i class="fas fa-paper-plane"></i> Kirim Konfirmasi';
            }
        });
    </script>
</body>
</html>
