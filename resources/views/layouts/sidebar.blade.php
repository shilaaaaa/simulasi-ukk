<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar Klasik Elegan - Biru Ungu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;700&family=Libre+Baskerville:wght@400;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        serif: ['Playfair Display', 'serif'],
                        baskerville: ['Libre Baskerville', 'serif'],
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        cream: '#FAF9F6',
                        'deep-navy': '#0F1729',
                        'royal-blue': '#1E3A8A',
                        'midnight': '#1a1f3a',
                        'lavender': '#E0E7FF',
                        'purple-mist': '#DDD6FE',
                        'indigo-deep': '#4F46E5',
                        'violet-accent': '#7C3AED',
                        'periwinkle': '#A5B4FC',
                    }
                }
            }
        }
    </script>
    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .animate-fade-in-up {
            animation: fadeInUp 0.5s ease-out backwards;
        }
        .delay-100 { animation-delay: 0.1s; }
        .delay-150 { animation-delay: 0.15s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-250 { animation-delay: 0.25s; }
        .delay-300 { animation-delay: 0.3s; }
        .delay-350 { animation-delay: 0.35s; }
        .delay-400 { animation-delay: 0.4s; }
        .delay-450 { animation-delay: 0.45s; }
        .delay-500 { animation-delay: 0.5s; }
        
        /* Gradient border animation */
        @keyframes borderFlow {
            0%, 100% { opacity: 0.3; }
            50% { opacity: 0.6; }
        }
        .border-glow {
            animation: borderFlow 3s ease-in-out infinite;
        }
    </style>
</head>
<body class="bg-cream min-h-screen flex font-sans">
    
    <!-- Sidebar -->
    <aside class="w-72 bg-gradient-to-br from-deep-navy via-midnight to-indigo-deep text-cream shadow-2xl flex flex-col relative overflow-hidden">
        
        <!-- Decorative gradient overlay -->
        <div class="absolute inset-0 bg-gradient-to-b from-violet-accent/10 via-transparent to-indigo-deep/20 pointer-events-none"></div>
        
        <!-- Decorative top border with gradient -->
        <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-periwinkle to-transparent border-glow"></div>
        
        <!-- Decorative right border -->
        <div class="absolute top-0 right-0 w-px h-full bg-gradient-to-b from-transparent via-indigo-deep/30 to-transparent"></div>
        
        <!-- Ambient glow effect -->
        <div class="absolute top-1/4 left-1/2 -translate-x-1/2 w-64 h-64 bg-violet-accent/20 rounded-full blur-3xl pointer-events-none"></div>
        
        <!-- Logo Section -->
        <div class="px-8 pt-10 pb-8 border-b border-periwinkle/20 relative z-10">
            <h1 class="font-serif text-3xl font-bold tracking-wide relative pb-4 text-transparent bg-clip-text bg-gradient-to-r from-lavender via-periwinkle to-purple-mist">
                Inventory
                <span class="absolute bottom-0 left-0 w-16 h-0.5 bg-gradient-to-r from-indigo-deep via-violet-accent to-transparent shadow-lg shadow-violet-accent/40"></span>
            </h1>
            <p class="text-xs tracking-widest mt-3 opacity-60 font-light uppercase text-lavender">shils</p>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 py-4 overflow-y-auto relative z-10">
            
            <!-- Main Section -->
            <div class="mb-8">
                <div class="px-8 mb-3 text-[10px] uppercase tracking-widest opacity-40 font-medium text-periwinkle">
                    Utama
                </div>
                
                <a href="/admin/inventaris" class="group flex items-center px-8 py-3.5 text-sm tracking-wide font-normal transition-all duration-300 relative bg-gradient-to-r from-indigo-deep/40 to-violet-accent/20 text-periwinkle font-medium border-l-2 border-violet-accent shadow-lg shadow-violet-accent/20 animate-fade-in-up delay-100">
                    
                    Inventaris
                </a>
                <a href="/admin/peminjaman" class="group flex items-center px-8 py-3.5 text-sm tracking-wide font-normal transition-all duration-300 relative bg-gradient-to-r from-indigo-deep/40 to-violet-accent/20 text-periwinkle font-medium border-l-2 border-violet-accent shadow-lg shadow-violet-accent/20 animate-fade-in-up delay-100">                    
                  Peminjaman
                </a>

                
            </div>

           
        </nav>

       
    </aside>

    <!-- Main Content Area (Demo) -->
    <main class="flex-1 p-16 bg-cream">
        @yield('content')
    </main>

</body>
</html>