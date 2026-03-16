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
    
    @stack('styles')
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Sidebar simplu pentru paginile de autentificare -->
        <aside class="w-64 bg-white shadow-lg">
            <div class="p-6 border-b">
                <a href="{{ route('login') }}" class="block">
                    <h1 class="text-2xl font-bold text-blue-600">
                        <i class="fas fa-graduation-cap mr-2"></i>
                        Catalog Școlar
                    </h1>
                    <p class="text-sm text-gray-500 mt-1">Sistem de management școlar</p>
                </a>
            </div>
            
            <div class="p-6">
                <p class="text-sm text-gray-600">
                    Bine ați venit! Pentru a accesa sistemul, vă rugăm să vă autentificați.
                </p>
            </div>
        </aside>
        
        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Header simplu -->
            <header class="bg-white shadow-sm">
                <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-gray-800">@yield('header', 'Autentificare')</h2>
                    <div class="flex items-center space-x-4">
                        <span class="text-sm text-gray-500">{{ now()->format('d.m.Y') }}</span>
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