@extends('layouts.app')

@section('title', 'Înscrie Elev')
@section('header', 'Înscriere Elev Nou')

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b">
                <h3 class="text-lg font-semibold">Date Elev</h3>
            </div>
            
            <form action="{{ route('elevi.store') }}" method="POST" class="p-6">
                @csrf
                
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label for="nume" class="block text-sm font-medium text-gray-700 mb-2">Nume *</label>
                        <input type="text" name="nume" id="nume" value="{{ old('nume') }}" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 @error('nume') border-red-500 @enderror"
                            placeholder="Ex: Popescu">
                        @error('nume')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="prenume" class="block text-sm font-medium text-gray-700 mb-2">Prenume *</label>
                        <input type="text" name="prenume" id="prenume" value="{{ old('prenume') }}" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 @error('prenume') border-red-500 @enderror"
                            placeholder="Ex: Ion">
                        @error('prenume')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div class="grid grid-cols-2 gap-6 mt-6">
                    <div>
                        <label for="numar_matricol" class="block text-sm font-medium text-gray-700 mb-2">Număr Matricol *</label>
                        <input type="text" name="numar_matricol" id="numar_matricol" value="{{ old('numar_matricol') }}" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 @error('numar_matricol') border-red-500 @enderror"
                            placeholder="Ex: 9001">
                        @error('numar_matricol')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="clasa_id" class="block text-sm font-medium text-gray-700 mb-2">Clasă *</label>
                        <select name="clasa_id" id="clasa_id" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 @error('clasa_id') border-red-500 @enderror">
                            <option value="">Selectează clasa</option>
                            @foreach($clase as $clasa)
                                <option value="{{ $clasa->id }}" {{ old('clasa_id', request('clasa_id')) == $clasa->id ? 'selected' : '' }}>
                                    {{ $clasa->nume_complet }}
                                </option>
                            @endforeach
                        </select>
                        @error('clasa_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div class="grid grid-cols-2 gap-6 mt-6">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 @error('email') border-red-500 @enderror"
                            placeholder="exemplu@email.com">
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="telefon" class="block text-sm font-medium text-gray-700 mb-2">Telefon</label>
                        <input type="text" name="telefon" id="telefon" value="{{ old('telefon') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 @error('telefon') border-red-500 @enderror"
                            placeholder="07xxxxxxxx">
                        @error('telefon')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div class="mt-6">
                    <label for="data_nasterii" class="block text-sm font-medium text-gray-700 mb-2">Data Nașterii</label>
                    <input type="date" name="data_nasterii" id="data_nasterii" value="{{ old('data_nasterii') }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 @error('data_nasterii') border-red-500 @enderror">
                    @error('data_nasterii')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mt-6">
                    <label for="observatii" class="block text-sm font-medium text-gray-700 mb-2">Observații</label>
                    <textarea name="observatii" id="observatii" rows="3"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 @error('observatii') border-red-500 @enderror"
                        placeholder="Observații despre elev...">{{ old('observatii') }}</textarea>
                    @error('observatii')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="flex justify-end space-x-3 mt-6 pt-6 border-t">
                    <a href="{{ route('elevi.index') }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                        Anulează
                    </a>
                    <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                        <i class="fas fa-save mr-2"></i> Înscrie Elev
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
