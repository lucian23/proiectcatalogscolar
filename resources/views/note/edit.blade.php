@extends('layouts.app')

@section('title', 'Editează Notă')
@section('header', 'Modifică Notă')

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b">
                <h3 class="text-lg font-semibold">Modifică Informații Notă</h3>
            </div>
            
            <form action="{{ route('note.update', $nota) }}" method="POST" class="p-6">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-2 gap-6">
                    <div class="col-span-2">
                        <label for="elev_id" class="block text-sm font-medium text-gray-700 mb-2">Elev *</label>
                        <select name="elev_id" id="elev_id" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 @error('elev_id') border-red-500 @enderror">
                            <option value="">Selectează elevul</option>
                            @foreach($elevi as $elev)
                                <option value="{{ $elev->id }}" {{ old('elev_id', $nota->elev_id) == $elev->id ? 'selected' : '' }}>
                                    {{ $elev->nume_complet }} ({{ $elev->clasa->nume_complet ?? 'Fără clasă' }})
                                </option>
                            @endforeach
                        </select>
                        @error('elev_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div class="grid grid-cols-2 gap-6 mt-6">
                    <div>
                        <label for="materie_id" class="block text-sm font-medium text-gray-700 mb-2">Materie *</label>
                        <select name="materie_id" id="materie_id" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 @error('materie_id') border-red-500 @enderror">
                            <option value="">Selectează materia</option>
                            @foreach($materii as $materie)
                                <option value="{{ $materie->id }}" {{ old('materie_id', $nota->materie_id) == $materie->id ? 'selected' : '' }}>
                                    {{ $materie->nume }}
                                </option>
                            @endforeach
                        </select>
                        @error('materie_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="profesor_id" class="block text-sm font-medium text-gray-700 mb-2">Profesor *</label>
                        <select name="profesor_id" id="profesor_id" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 @error('profesor_id') border-red-500 @enderror">
                            <option value="">Selectează profesorul</option>
                            @foreach($profesori as $profesor)
                                <option value="{{ $profesor->id }}" {{ old('profesor_id', $nota->profesor_id) == $profesor->id ? 'selected' : '' }}>
                                    {{ $profesor->nume_complet }}
                                </option>
                            @endforeach
                        </select>
                        @error('profesor_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div class="grid grid-cols-3 gap-6 mt-6">
                    <div>
                        <label for="nota" class="block text-sm font-medium text-gray-700 mb-2">Notă *</label>
                        <input type="number" name="nota" id="nota" value="{{ old('nota', $nota->nota) }}" required min="1" max="10" step="0.01"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 @error('nota') border-red-500 @enderror"
                            placeholder="Ex: 8.50">
                        @error('nota')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="tip" class="block text-sm font-medium text-gray-700 mb-2">Tip Notă *</label>
                        <select name="tip" id="tip" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 @error('tip') border-red-500 @enderror">
                            <option value="curenta" {{ old('tip', $nota->tip) == 'curenta' ? 'selected' : '' }}>Curentă</option>
                            <option value="teza" {{ old('tip', $nota->tip) == 'teza' ? 'selected' : '' }}>Teză</option>
                            <option value="recuperare" {{ old('tip', $nota->tip) == 'recuperare' ? 'selected' : '' }}>Recuperare</option>
                        </select>
                        @error('tip')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="data" class="block text-sm font-medium text-gray-700 mb-2">Data *</label>
                        <input type="date" name="data" id="data" value="{{ old('data', $nota->data->format('Y-m-d')) }}" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 @error('data') border-red-500 @enderror">
                        @error('data')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div class="mt-6">
                    <label for="observatii" class="block text-sm font-medium text-gray-700 mb-2">Observații</label>
                    <textarea name="observatii" id="observatii" rows="3"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 @error('observatii') border-red-500 @enderror"
                        placeholder="Observații opționale...">{{ old('observatii', $nota->observatii) }}</textarea>
                    @error('observatii')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="flex justify-end space-x-3 mt-6 pt-6 border-t">
                    <a href="{{ route('note.index') }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                        Anulează
                    </a>
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                        <i class="fas fa-save mr-2"></i> Salvează Modificările
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
