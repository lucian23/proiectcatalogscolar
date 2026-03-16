@extends('layouts.app')

@section('title', 'Detalii Profesor')
@section('header', 'Fișă Profesor: ' . $profesor->nume_complet)

@section('content')
    <div class="mb-6">
        <a href="{{ route('profesori.index') }}" class="text-blue-600 hover:text-blue-800">
            <i class="fas fa-arrow-left mr-2"></i> Înapoi la profesori
        </a>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Informații Profesor -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="text-center mb-6">
                <div class="w-24 h-24 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-3xl font-bold text-purple-600">{{ substr($profesor->nume, 0, 1) }}{{ substr($profesor->prenume, 0, 1) }}</span>
                </div>
                
                <h2 class="text-xl font-bold">{{ $profesor->nume_complet }}</h2>
                
                <span class="px-3 py-1 mt-2 inline-block rounded-full text-sm {{ $profesor->activ ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                    {{ $profesor->activ ? 'Activ' : 'Inactiv' }}
                </span>
            </div>
            
            <div class="space-y-3 border-t pt-4">
                <div class="flex justify-between">
                    <span class="text-gray-600">Email:</span>
                    <span class="font-medium">{{ $profesor->email }}</span>
                </div>
                
                <div class="flex justify-between">
                    <span class="text-gray-600">Telefon:</span>
                    <span class="font-medium">{{ $profesor->telefon ?? '-' }}</span>
                </div>
                
                <div class="flex justify-between">
                    <span class="text-gray-600">Grad Didactic:</span>
                    <span class="font-medium">{{ $profesor->grad_didactic ?? 'N/A' }}</span>
                </div>
                
                <div class="flex justify-between border-t pt-3">
                    <span class="text-gray-600">Materii Predate:</span>
                    <span class="font-bold text-purple-600">{{ $profesor->materii->count() }}</span>
                </div>
            </div>
            
            <div class="mt-6 flex space-x-3">
                <a href="{{ route('profesori.edit', $profesor) }}" class="flex-1 bg-yellow-500 hover:bg-yellow-600 text-white text-center px-4 py-2 rounded">
                    <i class="fas fa-edit mr-2"></i> Editează
                </a>
            </div>
        </div>
        
        <!-- Materii Predate -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow mb-6">
                <div class="px-6 py-4 border-b">
                    <h3 class="text-lg font-semibold">Materii Predate</h3>
                </div>
                
                <div class="p-6">
                    <div class="flex flex-wrap gap-2">
                        @forelse($profesor->materii as $materie)
                            <span class="px-4 py-2 bg-purple-100 text-purple-800 rounded-full text-sm font-medium">
                                {{ $materie->nume }}
                            </span>
                        @empty
                            <p class="text-gray-500">Nu sunt materii asociate.</p>
                        @endforelse
                    </div>
                </div>
            </div>
            
            
            <!-- Note Adăugate Recent -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b flex justify-between items-center">
                    <h3 class="text-lg font-semibold">Note Adăugate Recent</h3>
                    <span class="text-sm text-gray-500">Total: {{ $profesor->note->count() }}</span>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Data</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Elev</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Materie</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Notă</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($profesor->note->sortByDesc('data')->take(10) as $nota)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $nota->data->format('d.m.Y') }}</td>
                                    
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $nota->elev->nume_complet ?? 'N/A' }}</td>
                                    
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $nota->materie->nume ?? 'N/A' }}</td>
                                    
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <span class="font-bold {{ $nota->nota >= 8 ? 'text-green-600' : ($nota->nota >= 5 ? 'text-yellow-600' : 'text-red-600') }}">
                                            {{ $nota->nota }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">Nu există note adăugate.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
