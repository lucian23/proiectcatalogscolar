@extends('layouts.app')

@section('title', 'Detalii Clasă')
@section('header', 'Detalii Clasă: ' . $clasa->nume_complet)

@section('content')
    <div class="mb-6">
        <a href="{{ route('clase.index') }}" class="text-blue-600 hover:text-blue-800">
            <i class="fas fa-arrow-left mr-2"></i> Înapoi la clase
        </a>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Informații Clasă -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold mb-4 border-b pb-2">Informații Generale</h3>
            
            <div class="space-y-3">
                <div class="flex justify-between">
                    <span class="text-gray-600">Nume:</span>
                    <span class="font-medium">{{ $clasa->nume }}</span>
                </div>
                
                <div class="flex justify-between">
                    <span class="text-gray-600">An de studiu:</span>
                    <span class="font-medium">{{ $clasa->an }}</span>
                </div>
                
                <div class="flex justify-between">
                    <span class="text-gray-600">Profil:</span>
                    <span class="font-medium">{{ $clasa->profil ?? 'N/A' }}</span>
                </div>
                
                <div class="flex justify-between">
                    <span class="text-gray-600">An Școlar:</span>
                    <span class="font-medium">{{ $clasa->an_scolar }}</span>
                </div>
                
                <div class="flex justify-between border-t pt-3">
                    <span class="text-gray-600">Total Elevi:</span>
                    <span class="font-bold text-blue-600">{{ $clasa->elevi->count() }}</span>
                </div>
            </div>
            
            <div class="mt-6 flex space-x-3">
                <a href="{{ route('clase.edit', $clasa) }}" class="flex-1 bg-yellow-500 hover:bg-yellow-600 text-white text-center px-4 py-2 rounded">
                    <i class="fas fa-edit mr-2"></i> Editează
                </a>
                
                <a href="{{ route('elevi.create') }}?clasa_id={{ $clasa->id }}" class="flex-1 bg-green-600 hover:bg-green-700 text-white text-center px-4 py-2 rounded">
                    <i class="fas fa-user-plus mr-2"></i> Adaugă Elev
                </a>
            </div>
        </div>
        
        <!-- Lista Elevi -->
        <div class="lg:col-span-2 bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b flex justify-between items-center">
                <h3 class="text-lg font-semibold">Elevi înscriși</h3>
                <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">{{ $clasa->elevi->count() }} elevi</span>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nr. Matricol</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nume</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Contact</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Medie</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Acțiuni</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($clasa->elevi as $elev)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">{{ $elev->numar_matricol }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $elev->nume_complet }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $elev->email ?? '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    @php
                                        $medie = $elev->medie_generala;
                                        $culoare = $medie >= 8 ? 'green' : ($medie >= 5 ? 'yellow' : 'red');
                                    @endphp
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ $culoare }}-100 text-{{ $culoare }}-800">
                                        {{ $medie > 0 ? number_format($medie, 2) : '-' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('elevi.show', $elev) }}" class="text-blue-600 hover:text-blue-900 mr-3">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('rapoarte.elev', $elev) }}" class="text-purple-600 hover:text-purple-900" title="Raport complet">
                                        <i class="fas fa-chart-bar"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                    Nu există elevi în această clasă.
                                    <a href="{{ route('elevi.create') }}?clasa_id={{ $clasa->id }}" class="text-green-600 hover:underline ml-2">Adaugă primul elev</a>.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
