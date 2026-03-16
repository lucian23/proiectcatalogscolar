@extends('layouts.app')

@section('title', 'Detalii Elev')
@section('header', 'Fișă Elev: ' . $elev->nume_complet)

@section('content')
    <div class="mb-6">
        <a href="{{ route('elevi.index') }}" class="text-blue-600 hover:text-blue-800">
            <i class="fas fa-arrow-left mr-2"></i> Înapoi la elevi
        </a>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Informații Elev -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="text-center mb-6">
                <div class="w-24 h-24 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-3xl font-bold text-blue-600">{{ substr($elev->nume, 0, 1) }}{{ substr($elev->prenume, 0, 1) }}</span>
                </div>
                
                <h2 class="text-xl font-bold">{{ $elev->nume_complet }}</h2>
                <p class="text-gray-500">{{ $elev->clasa->nume_complet ?? 'Fără clasă' }}</p>
            </div>
            
            <div class="space-y-3 border-t pt-4">
                <div class="flex justify-between">
                    <span class="text-gray-600">Nr. Matricol:</span>
                    <span class="font-medium">{{ $elev->numar_matricol }}</span>
                </div>
                
                <div class="flex justify-between">
                    <span class="text-gray-600">Email:</span>
                    <span class="font-medium">{{ $elev->email ?? '-' }}</span>
                </div>
                
                <div class="flex justify-between">
                    <span class="text-gray-600">Telefon:</span>
                    <span class="font-medium">{{ $elev->telefon ?? '-' }}</span>
                </div>
                
                <div class="flex justify-between">
                    <span class="text-gray-600">Data Nașterii:</span>
                    <span class="font-medium">{{ $elev->data_nasterii ? $elev->data_nasterii->format('d.m.Y') : '-' }}</span>
                </div>
                
                <div class="flex justify-between">
                    <span class="text-gray-600">Data Înscrierii:</span>
                    <span class="font-medium">{{ $elev->data_inscrierii->format('d.m.Y') }}</span>
                </div>
                
                <div class="flex justify-between border-t pt-3">
                    <span class="text-gray-600">Status:</span>
                    <span class="px-2 py-1 text-xs rounded-full {{ $elev->activ ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $elev->activ ? 'Activ' : 'Inactiv' }}
                    </span>
                </div>
            </div>
            
            <div class="mt-6 flex space-x-3">
                <a href="{{ route('elevi.edit', $elev->id) }}" class="flex-1 bg-yellow-500 hover:bg-yellow-600 text-white text-center px-4 py-2 rounded">
                    <i class="fas fa-edit mr-2"></i> Editează
                </a>
                
                <a href="{{ route('note.create') }}?elev_id={{ $elev->id }}" class="flex-1 bg-red-600 hover:bg-red-700 text-white text-center px-4 py-2 rounded">
                    <i class="fas fa-plus mr-2"></i> Adaugă Notă
                </a>
            </div>
        </div>
        
        <!-- Note pe Materii -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Medie Generală -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600">Medie Generală</p>
                        <p class="text-4xl font-bold {{ $elev->medie_generala >= 8 ? 'text-green-600' : ($elev->medie_generala >= 5 ? 'text-yellow-600' : 'text-red-600') }}">
                            {{ $elev->medie_generala > 0 ? number_format($elev->medie_generala, 2) : '-' }}
                        </p>
                    </div>
                    
                    <div class="text-right">
                        <p class="text-gray-600">Total Note</p>
                        <p class="text-2xl font-bold text-blue-600">{{ $elev->note->count() }}</p>
                    </div>
                </div>
            </div>
            
            <!-- Note pe Materii -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b">
                    <h3 class="text-lg font-semibold">Situație pe Materii</h3>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Materie</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Note</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Teză</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Medie</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @php
                                $notePeMaterii = $elev->note->groupBy('materie_id');
                            @endphp
                            
                            @forelse($notePeMaterii as $materieId => $noteMaterie)
                                @php
                                    $materie = $noteMaterie->first()->materie;
                                    $noteCurente = $noteMaterie->where('tip', 'curenta');
                                    $teza = $noteMaterie->where('tip', 'teza')->first();
                                    $medie = $noteMaterie->avg('nota');
                                @endphp
                                
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap font-medium">{{ $materie->nume }}</td>
                                    
                                    <td class="px-6 py-4 text-center">
                                        @foreach($noteCurente as $nota)
                                            <span class="inline-block px-2 py-1 mx-1 text-xs rounded-full {{ $nota->nota >= 8 ? 'bg-green-100 text-green-800' : ($nota->nota >= 5 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                                {{ $nota->nota }}
                                            </span>
                                        @endforeach
                                    </td>
                                    
                                    <td class="px-6 py-4 text-center">
                                        @if($teza)
                                            <span class="px-2 py-1 text-xs rounded-full bg-purple-100 text-purple-800">{{ $teza->nota }}</span>
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </td>
                                    
                                    <td class="px-6 py-4 text-center">
                                        <span class="font-bold {{ $medie >= 8 ? 'text-green-600' : ($medie >= 5 ? 'text-yellow-600' : 'text-red-600') }}">
                                            {{ number_format($medie, 2) }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                        Nu există note pentru acest elev.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- Istoric Note -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b flex justify-between items-center">
                    <h3 class="text-lg font-semibold">Istoric Note</h3>
                    <a href="{{ route('rapoarte.elev', $elev->id) }}" class="text-blue-600 hover:text-blue-800 text-sm">Vezi raport complet →</a>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Data</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Materie</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Tip</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Notă</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Profesor</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($elev->note->sortByDesc('data')->take(10) as $nota)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $nota->data->format('d.m.Y') }}</td>
                                    
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $nota->materie->nume }}</td>
                                    
                                    <td class="px-6 py-4 text-center">
                                        @php
                                            $tipColors = [
                                                'curenta' => 'bg-blue-100 text-blue-800',
                                                'teza' => 'bg-purple-100 text-purple-800',
                                                'recuperare' => 'bg-orange-100 text-orange-800',
                                            ];
                                            $tipLabels = [
                                                'curenta' => 'Curentă',
                                                'teza' => 'Teză',
                                                'recuperare' => 'Recuperare',
                                            ];
                                        @endphp
                                        <span class="px-2 py-1 text-xs rounded-full {{ $tipColors[$nota->tip] ?? 'bg-gray-100' }}">
                                            {{ $tipLabels[$nota->tip] ?? $nota->tip }}
                                        </span>
                                    </td>
                                    
                                    <td class="px-6 py-4 text-center">
                                        <span class="font-bold {{ $nota->nota >= 8 ? 'text-green-600' : ($nota->nota >= 5 ? 'text-yellow-600' : 'text-red-600') }}">
                                            {{ $nota->nota }}
                                        </span>
                                    </td>
                                    
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $nota->profesor->nume_complet ?? 'N/A' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">Nu există note.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
