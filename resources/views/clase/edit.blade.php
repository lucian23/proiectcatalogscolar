@extends('layouts.app')

@section('title', 'Editează Clasă')
@section('header', 'Editează Clasă: ' . $clasa->nume_complet)

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b">
                <h3 class="text-lg font-semibold">Modifică Informații Clasă</h3>
            </div>
            
            <form action="{{ route('clase.update', $clasa->id) }}" method="POST" class="p-6">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label for="nume" class="block text-sm font-medium text-gray-700 mb-2">Nume Clasă *</label>
                        <input type="text" name="nume" id="nume" value="{{ old('nume', $clasa->nume) }}" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('nume') border-red-500 @enderror"
                            placeholder="Ex: A, B, C">
                        @error('nume')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="an" class="block text-sm font-medium text-gray-700 mb-2">An de studiu *</label>
                        <select name="an" id="an" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('an') border-red-500 @enderror">
                            <option value="">Selectează anul</option>
                            @for($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}" {{ old('an', $clasa->an) == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                        @error('an')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div class="grid grid-cols-2 gap-6 mt-6">
                    <div>
                        <label for="profil" class="block text-sm font-medium text-gray-700 mb-2">Profil</label>
                        <input type="text" name="profil" id="profil" value="{{ old('profil', $clasa->profil) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('profil') border-red-500 @enderror"
                            placeholder="Ex: Real, Uman, Științe">
                        @error('profil')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="an_scolar" class="block text-sm font-medium text-gray-700 mb-2">An Școlar *</label>
                        <input type="number" name="an_scolar" id="an_scolar" value="{{ old('an_scolar', $clasa->an_scolar) }}" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('an_scolar') border-red-500 @enderror"
                            placeholder="Ex: 2025">
                        @error('an_scolar')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div class="flex justify-end space-x-3 mt-6 pt-6 border-t">
                    <a href="{{ route('clase.index') }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                        Anulează
                    </a>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        <i class="fas fa-save mr-2"></i> Salvează Modificările
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
