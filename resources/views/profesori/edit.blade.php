@extends('layouts.app')

@section('title', 'Editează Profesor')
@section('header', 'Editează Profesor: ' . $profesor->nume_complet)

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b">
                <h3 class="text-lg font-semibold">Modifică Date Profesor</h3>
            </div>
            
            <form action="{{ route('profesori.update', $profesor) }}" method="POST" class="p-6">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label for="nume" class="block text-sm font-medium text-gray-700 mb-2">Nume *</label>
                        <input type="text" name="nume" id="nume" value="{{ old('nume', $profesor->nume) }}" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 @error('nume') border-red-500 @enderror"
                            placeholder="Ex: Popescu">
                        @error('nume')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="prenume" class="block text-sm font-medium text-gray-700 mb-2">Prenume *</label>
                        <input type="text" name="prenume" id="prenume" value="{{ old('prenume', $profesor->prenume) }}" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 @error('prenume') border-red-500 @enderror"
                            placeholder="Ex: Ion">
                        @error('prenume')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div class="mt-6">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $profesor->email) }}" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 @error('email') border-red-500 @enderror"
                        placeholder="nume@scoala.ro">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="grid grid-cols-2 gap-6 mt-6">
                    <div>
                        <label for="telefon" class="block text-sm font-medium text-gray-700 mb-2">Telefon</label>
                        <input type="text" name="telefon" id="telefon" value="{{ old('telefon', $profesor->telefon) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 @error('telefon') border-red-500 @enderror"
                            placeholder="07xxxxxxxx">
                        @error('telefon')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="grad_didactic" class="block text-sm font-medium text-gray-700 mb-2">Grad Didactic</label>
                        <select name="grad_didactic" id="grad_didactic"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 @error('grad_didactic') border-red-500 @enderror">
                            <option value="">Selectează gradul</option>
                            <option value="I" {{ old('grad_didactic', $profesor->grad_didactic) == 'I' ? 'selected' : '' }}>Gradul I</option>
                            <option value="II" {{ old('grad_didactic', $profesor->grad_didactic) == 'II' ? 'selected' : '' }}>Gradul II</option>
                            <option value="Definitivat" {{ old('grad_didactic', $profesor->grad_didactic) == 'Definitivat' ? 'selected' : '' }}>Definitivat</option>
                            <option value="Începător" {{ old('grad_didactic', $profesor->grad_didactic) == 'Începător' ? 'selected' : '' }}>Începător</option>
                        </select>
                        @error('grad_didactic')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div class="mt-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Materii Predate</label>
                    
                    <div class="grid grid-cols-2 gap-3 border rounded-md p-4">
                        @foreach($materii as $materie)
                            <label class="flex items-center">
                                <input type="checkbox" name="materii[]" value="{{ $materie->id }}" 
                                    {{ in_array($materie->id, old('materii', $profesor->materii->pluck('id')->toArray())) ? 'checked' : '' }}
                                    class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                                <span class="ml-2 text-sm text-gray-700">{{ $materie->nume }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
                
                <div class="mt-6">
                    <label class="flex items-center">
                        <input type="checkbox" name="activ" value="1" {{ old('activ', $profesor->activ) ? 'checked' : '' }}
                            class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                        <span class="ml-2 text-sm text-gray-700">Profesor activ</span>
                    </label>
                </div>
                
                <div class="flex justify-end space-x-3 mt-6 pt-6 border-t">
                    <a href="{{ route('profesori.index') }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                        Anulează
                    </a>
                    <button type="submit" class="px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700">
                        <i class="fas fa-save mr-2"></i> Salvează Modificările
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
