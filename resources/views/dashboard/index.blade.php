@extends('layouts.app')

@section('title', 'Dashboard')
@section('header', 'Panou de Control')

@section('content')
    <!-- Statistici -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <i class="fas fa-chalkboard text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-500">Total Clase</p>
                    <p class="text-2xl font-bold">{{ $statistici['total_clase'] }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <i class="fas fa-users text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-500">Elevi Activi</p>
                    <p class="text-2xl font-bold">{{ $statistici['total_elevi'] }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                    <i class="fas fa-book text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-500">Materii</p>
                    <p class="text-2xl font-bold">{{ $statistici['total_materii'] }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                    <i class="fas fa-chalkboard-teacher text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-500">Profesori</p>
                    <p class="text-2xl font-bold">{{ $statistici['total_profesori'] }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-red-100 text-red-600">
                    <i class="fas fa-star text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-500">Total Note</p>
                    <p class="text-2xl font-bold">{{ $statistici['total_note'] }}</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Clase -->
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b flex justify-between items-center">
                <h3 class="text-lg font-semibold">Clase</h3>
                <a href="{{ route('clase.index') }}" class="text-blue-600 hover:text-blue-800 text-sm">Vezi toate →</a>
            </div>
            <div class="p-6">
                <div class="space-y-3">
                    @forelse($clase as $clasa)
                        <div class="flex justify-between items-center p-3 bg-gray-50 rounded">
                            <div>
                                <span class="font-medium">{{ $clasa->nume_complet }}</span>
                                <span class="text-sm text-gray-500">({{ $clasa->an_scolar }})</span>
                            </div>
                            <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">
                                {{ $clasa->elevi_count }} elevi
                            </span>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center">Nu există clase încă.</p>
                    @endforelse
                </div>
            </div>
        </div>
        
        <!-- Elevi Recenți -->
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b flex justify-between items-center">
                <h3 class="text-lg font-semibold">Elevi Recenți</h3>
                <a href="{{ route('elevi.index') }}" class="text-blue-600 hover:text-blue-800 text-sm">Vezi toți →</a>
            </div>
            <div class="p-6">
                <div class="space-y-3">
                    @forelse($elevi_recenți as $elev)
                        <div class="flex justify-between items-center p-3 bg-gray-50 rounded">
                            <div>
                                <p class="font-medium">{{ $elev->nume_complet }}</p>
                                <p class="text-sm text-gray-500">{{ $elev->clasa->nume_complet ?? 'Fără clasă' }}</p>
                            </div>
                            <span class="text-sm text-gray-400">
                                {{ $elev->created_at->diffForHumans() }}
                            </span>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center">Nu există elevi încă.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    
    <!-- Note Recente -->
    <div class="mt-8 bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b flex justify-between items-center">
            <h3 class="text-lg font-semibold">Note Adăugate Recent</h3>
            <a href="{{ route('note.index') }}" class="text-blue-600 hover:text-blue-800 text-sm">Vezi toate →</a>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Elev</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Materie</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Nota</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Data</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($note_recenți as $nota)
                        <tr>
                            <td class="px-6 py-4">{{ $nota->elev->nume_complet ?? 'N/A' }}</td>
                            <td class="px-6 py-4">{{ $nota->materie->nume ?? 'N/A' }}</td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-sm font-medium 
                                    {{ $nota->nota >= 8 ? 'bg-green-100 text-green-800' : ($nota->nota >= 5 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                    {{ $nota->nota }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $nota->data->format('d.m.Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">Nu există note încă.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Acțiuni Rapide -->
    <div class="mt-8 grid grid-cols-1 md:grid-cols-4 gap-4">
        <a href="{{ route('clase.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white rounded-lg p-4 text-center transition">
            <i class="fas fa-plus-circle text-2xl mb-2"></i>
            <p>Adaugă Clasă</p>
        </a>
        
        <a href="{{ route('elevi.create') }}" class="bg-green-600 hover:bg-green-700 text-white rounded-lg p-4 text-center transition">
            <i class="fas fa-user-plus text-2xl mb-2"></i>
            <p>Înscrie Elev</p>
        </a>
        
        <a href="{{ route('profesori.create') }}" class="bg-purple-600 hover:bg-purple-700 text-white rounded-lg p-4 text-center transition">
            <i class="fas fa-user-tie text-2xl mb-2"></i>
            <p>Adaugă Profesor</p>
        </a>
        
        <a href="{{ route('note.create') }}" class="bg-red-600 hover:bg-red-700 text-white rounded-lg p-4 text-center transition">
            <i class="fas fa-plus text-2xl mb-2"></i>
            <p>Adaugă Notă</p>
        </a>
    </div>
@endsection
