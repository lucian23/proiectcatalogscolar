@extends('layouts.app')

@section('title', 'Editează Materie')
@section('header', 'Editează Materie: ' . $materie->nume)

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b">
                <h3 class="text-lg font-semibold">Modifică Informații Materie</h3>
            </div>
            
            <form action="{{ route('materii.update', $materie->id) }}" method="POST" class="p-6">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label for="nume" class="block text-sm font-medium text-gray-700 mb-2">Nume Materie *</label>
                        <input type="text" name="nume" id="nume" value="{{ old('nume', $materie->nume) }}" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('nume') border-red-500 @enderror"
                            placeholder="Ex: Matematică">
                        @error('nume')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="cod" class="block text-sm font-medium text-gray-700 mb-2">Cod *</label>
                        <input type="text" name="cod" id="cod" value="{{ old('cod', $materie->cod) }}" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('cod') border-red-500 @enderror"
                            placeholder="Ex: MAT">
                        @error('cod')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div class="mt-6">
                    <label for="descriere" class="block text-sm font-medium text-gray-700 mb-2">Descriere</label>
                    <textarea name="descriere" id="descriere" rows="3"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('descriere') border-red-500 @enderror"
                        placeholder="Descriere opțională...">{{ old('descriere', $materie->descriere) }}</textarea>
                    @error('descriere')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mt-6">
                    <label class="flex items-center">
                        <input type="checkbox" name="obligatorie" value="1" {{ old('obligatorie', $materie->obligatorie) ? 'checked' : '' }}
                            class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <span class="ml-2 text-sm text-gray-700">Materie obligatorie</span>
                    </label>
                </div>
                
                <div class="flex justify-end space-x-3 mt-6 pt-6 border-t">
                    <a href="{{ route('materii.index') }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                        Anulează
                    </a>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                        <i class="fas fa-save mr-2"></i> Salvează Modificările
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
