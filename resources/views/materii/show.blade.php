@extends('layouts.app')

@section('title', 'Detalii Materie')
@section('header', 'Informații Materie: ' . $materie->nume)

@section('content')
    <div class="mb-6">
        <a href="{{ route('materii.index') }}" class="text-blue-600 hover:text-blue-800">
            <i class="fas fa-arrow-left mr-2"></i> Înapoi la materii
        </a>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Informații Materie -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="text-center mb-6">
                <div class="w-24 h-24 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-book text-4xl text-indigo-600"></i>
                </div>
                
                <h2 class="text-xl font-bold">{{ $materie->nume }}</h2>
                
                <span class="px-3 py-1 mt-2 inline-block rounded-full text-sm {{ $materie->obligatorie ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                    {{ $materie->obligatorie ? 'Obligatorie' : 'Opțională' }}
                </span>
            </div>
            
            <div class="space-y-3 border-t pt-4">
                <div class="flex justify-between">
                    <span class="text-gray-600">Cod:</span>
                    <span class="font-medium">{{ $materie->cod }}</span>
                </div>
                
                <div class="flex justify-between border-t pt-3">
                    <span class="text-gray-600">Profesori:</span>
                    <span class="font-bold text-indigo-600">{{ $materie->profesori->count() }}</span>
                </div>
                
                <div class="flex justify-between">
                    <span class="text-gray-600">Total Note:</span>
                    <span class="font-bold text-blue-600">{{ $materie->note->count() }}</span>
                </div>
            </div>
            
            <div class="mt-6">
                <h4 class="font-medium text-gray-700 mb-2">Descriere:</h4>
                <p class="text-gray-600 text-sm">{{ $materie->descriere ?? 'Nu există descriere.' }}</p>
            </div>
            
            <div class="mt-6 flex space-x-3">
                <a href="{{ route('materii.edit', $materie->id) }}" class="flex-1 bg-yellow-500 hover:bg-yellow-600 text-white text-center px-4 py-2 rounded">
                    <i class="fas fa-edit mr-2"></i> Editează
                </a>
            </div>
        </div>
        
        <!-- Profesori și Statistici -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Profesori -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b">
                    <h3 class="text-lg font-semibold">Profesori care predau această materie</h3>
                </div>
                
                <div class="p-6">
                    <div class="flex flex-wrap gap-2">
                        @forelse($materie->profesori as $profesor)
                            <a href="{{ route('profesori.show', $profesor->id) }}" class="px-4 py-2 bg-indigo-100 text-indigo-800 rounded-full text-sm font-medium hover:bg-indigo-200">
                                {{ $profesor->nume_complet }}
                            </a>
                        @empty
                            <p class="text-gray-500">Nu sunt profesori asociați.</p>
                        @endforelse
                    </div>
                </div>
            </div>
            
            
            <!-- Statistici Note -->
            @if($materie->note->count() > 0)
                @php
                    $medieGenerală = $materie->note->avg('nota');
                    $noteBune = $materie->note->where('nota', '>=', 8)->count();
                    $noteSuficiente = $materie->note->whereBetween('nota', [5, 7.99])->count();
                    $noteInsuficiente = $materie->note->where('nota', '<', 5)->count();
                @endphp
                
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold mb-4">Statistici Note</h3>
                    
                    <div class="grid grid-cols-4 gap-4">
                        <div class="text-center p-4 bg-blue-50 rounded-lg">
                            <p class="text-2xl font-bold text-blue-600">{{ number_format($medieGenerală, 2) }}</p>
                            <p class="text-sm text-gray-600">Medie Generală</p>
                        </div>
                        
                        <div class="text-center p-4 bg-green-50 rounded-lg">
                            <p class="text-2xl font-bold text-green-600">{{ $noteBune }}</p>
                            <p class="text-sm text-gray-600">Note Bune (8-10)</p>
                        </div>
                        
                        <div class="text-center p-4 bg-yellow-50 rounded-lg">
                            <p class="text-2xl font-bold text-yellow-600">{{ $noteSuficiente }}</p>
                            <p class="text-sm text-gray-600">Note Suficiente (5-7.99)</p>
                        </div>
                        
                        <div class="text-center p-4 bg-red-50 rounded-lg">
                            <p class="text-2xl font-bold text-red-600">{{ $noteInsuficiente }}</p>
                            <p class="text-sm text-gray-600">Note Insuficiente (<5)</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
