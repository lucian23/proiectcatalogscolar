@extends('layouts.app')

@section('title', 'Detalii Notă')
@section('header', 'Informații Notă')

@section('content')
    <div class="mb-6">
        <a href="{{ route('note.index') }}" class="text-blue-600 hover:text-blue-800">
            <i class="fas fa-arrow-left mr-2"></i> Înapoi la catalog
        </a>
    </div>
    
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b flex justify-between items-center">
                <h3 class="text-lg font-semibold">Detalii Notă</h3>
                
                <div class="flex space-x-2">
                    <a href="{{ route('note.edit', $nota) }}" class="text-yellow-600 hover:text-yellow-800">
                        <i class="fas fa-edit"></i> Editează
                    </a>
                    
                    <form action="{{ route('note.destroy', $nota) }}" method="POST" class="inline" onsubmit="return confirm('Ești sigur că vrei să ștergi această notă?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-800">
                            <i class="fas fa-trash"></i> Șterge
                        </button>
                    </form>
                </div>
            </div>
            
            <div class="p-6">
                <div class="text-center mb-8">
                    <p class="text-gray-600 mb-2">Nota acordată</p>
                    
                    <div class="text-6xl font-bold {{ $nota->nota >= 8 ? 'text-green-600' : ($nota->nota >= 5 ? 'text-yellow-600' : 'text-red-600') }}">
                        {{ $nota->nota }}
                    </div>
                    
                    <span class="mt-2 inline-block px-3 py-1 rounded-full text-sm {{ $nota->tip == 'teza' ? 'bg-purple-100 text-purple-800' : ($nota->tip == 'recuperare' ? 'bg-orange-100 text-orange-800' : 'bg-blue-100 text-blue-800') }}">
                        {{ $nota->tip == 'teza' ? 'Teză' : ($nota->tip == 'recuperare' ? 'Recuperare' : 'Notă Curentă') }}
                    </span>
                </div>
                
                <div class="grid grid-cols-2 gap-6 border-t pt-6">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Elev</p>
                        <a href="{{ route('elevi.show', $nota->elev) }}" class="text-lg font-medium text-blue-600 hover:text-blue-800">
                            {{ $nota->elev->nume_complet ?? 'N/A' }}
                        </a>
                    </div>
                    
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Materie</p>
                        <a href="{{ route('materii.show', $nota->materie) }}" class="text-lg font-medium text-indigo-600 hover:text-indigo-800">
                            {{ $nota->materie->nume ?? 'N/A' }}
                        </a>
                    </div>
                    
                    
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Profesor</p>
                        <a href="{{ route('profesori.show', $nota->profesor) }}" class="text-lg font-medium text-purple-600 hover:text-purple-800">
                            {{ $nota->profesor->nume_complet ?? 'N/A' }}
                        </a>
                    </div>
                    
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Data</p>
                        <p class="text-lg font-medium">{{ $nota->data->format('d.m.Y') }}</p>
                    </div>
                </div>
                
                
                @if($nota->observatii)
                    <div class="mt-6 border-t pt-6">
                        <p class="text-sm text-gray-600 mb-2">Observații</p>
                        <p class="text-gray-800 bg-gray-50 p-4 rounded">{{ $nota->observatii }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
