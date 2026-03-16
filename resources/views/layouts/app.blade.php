<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Catalog Școlar') - Catalog Online</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        .sidebar-link {
            @apply flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors;
        }
        .sidebar-link.active {
            @apply bg-blue-50 text-blue-600 border-r-4 border-blue-600;
        }
    </style>
    
    @stack('styles')
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-lg">
            <div class="p-6 border-b">
                <h1 class="text-2xl font-bold text-blue-600">
                    <i class="fas fa-graduation-cap mr-2"></i>
                    Catalog Școlar
                </h1>
                <p class="text-sm text-gray-500 mt-1">Sistem de management școlar</p>
            </div>
            
            <nav class="mt-6">
                <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fas fa-home w-6"></i>
                    <span>Dashboard</span>
                </a>
                
                <a href="{{ route('clase.index') }}" class="sidebar-link {{ request()->routeIs('clase.*') ? 'active' : '' }}">
                    <i class="fas fa-chalkboard w-6"></i>
                    <span>Clase</span>
                </a>
                
                <a href="{{ route('elevi.index') }}" class="sidebar-link {{ request()->routeIs('elevi.*') ? 'active' : '' }}">
                    <i class="fas fa-users w-6"></i>
                    <span>Elevi</span>
                </a>
                
                <a href="{{ route('profesori.index') }}" class="sidebar-link {{ request()->routeIs('profesori.*') ? 'active' : '' }}">
                    <i class="fas fa-chalkboard-teacher w-6"></i>
                    <span>Profesori</span>
                </a>
                
                <a href="{{ route('materii.index') }}" class="sidebar-link {{ request()->routeIs('materii.*') ? 'active' : '' }}">
                    <i class="fas fa-book w-6"></i>
                    <span>Materii</span>
                </a>
                
                <a href="{{ route('note.index') }}" class="sidebar-link {{ request()->routeIs('note.*') ? 'active' : '' }}">
                    <i class="fas fa-star w-6"></i>
                    <span>Note</span>
                </a>
                
                <div class="border-t mt-6 pt-6">
                    <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Rapoarte</p>
                    
                    <a href="{{ route('rapoarte.clase') }}" class="sidebar-link {{ request()->routeIs('rapoarte.clase') ? 'active' : '' }}">
                        <i class="fas fa-chart-bar w-6"></i>
                        <span>Situație clase</span>
                    </a>
                </div>
            </nav>
        </aside>
        
        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Header -->
            <header class="bg-white shadow-sm">
                <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-gray-800">@yield('header', 'Dashboard')</h2>
                    
                    <div class="flex items-center space-x-4">
                        <span class="text-sm text-gray-500">{{ now()->format('d.m.Y') }}</span>
                        <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center text-white text-sm font-bold">
                            A
                        </div>
                    </div>
                </div>
            </header>
            
            <!-- Flash Messages -->
            @if(session('success'))
                <div class="max-w-7xl mx-auto px-4 mt-4">
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                </div>
            @endif
            
            @if(session('error'))
                <div class="max-w-7xl mx-auto px-4 mt-4">
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                </div>
            @endif
            
            <!-- Page Content -->
            <main class="flex-1 max-w-7xl w-full mx-auto px-4 py-6">
                @yield('content')
            </main>
            
            <!-- Footer -->
            <footer class="bg-white border-t">
                <div class="max-w-7xl mx-auto px-4 py-4">
                    <p class="text-center text-sm text-gray-500">
                        © {{ date('Y') }} Catalog Școlar - Dezvoltat cu <i class="fas fa-heart text-red-500"></i> și Laravel
                    </p>
                </div>
            </footer>
        </div>
    </div>
    
    @stack('scripts')
</body>
</html>
