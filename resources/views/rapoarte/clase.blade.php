@extends('layouts.app')

@section('title', 'Raport Clase')
@section('header', 'Situație Generală pe Clase')

@section('content')
    <div class="mb-6">
        <a href="{{ route('dashboard') }}" class="text-blue-600 hover:text-blue-800">
            <i class="fas fa-arrow-left mr-2"></i> Înapoi la dashboard
        </a>
    </div>
    
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b flex justify-between items-center">
            <h3 class="text-lg font-semibold">Medii pe Clase și Materii</h3>
            <button onclick="window.print()" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded flex items-center">
                <i class="fas fa-print mr-2"></i> Tipărește
            </button>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Clasă</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Elevi</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Medie Generală</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Promovabilitate</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Acțiuni</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($clase as $clasa)
                        @php
                            $totalElevi = $clasa->elevi->count();
                            $medieClasa = 0;
                            $eleviPromovati = 0;
                            
                            foreach($clasa->elevi as $elev) {
                                $medieElev = $elev->medie_generala;
                                $medieClasa += $medieElev;
                                if($medieElev >= 5) $eleviPromovati++;
                            }
                            
                            $medieClasa = $totalElevi > 0 ? $medieClasa / $totalElevi : 0;
                            $promovabilitate = $totalElevi > 0 ? ($eleviPromovati / $totalElevi) * 100 : 0;
                        @endphp
                        
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $clasa->nume_complet }}</div>
                                <div class="text-sm text-gray-500">An școlar: {{ $clasa->an_scolar }}</div>
                            </td>
                            
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    {{ $totalElevi }}
                                </span>
                            </td>
                            
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <span class="font-bold {{ $medieClasa >= 8 ? 'text-green-600' : ($medieClasa >= 5 ? 'text-yellow-600' : 'text-red-600') }}">
                                    {{ $medieClasa > 0 ? number_format($medieClasa, 2) : '-' }}
                                </span>
                            </td>
                            
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <div class="flex items-center justify-center">
                                    <div class="w-16 bg-gray-200 rounded-full h-2.5 mr-2">
                                        <div class="bg-{{ $promovabilitate >= 80 ? 'green' : ($promovabilitate >= 50 ? 'yellow' : 'red') }}-600 h-2.5 rounded-full" style="width: {{ $promovabilitate }}%"></div>
                                    </div>
                                    <span class="text-sm font-medium">{{ number_format($promovabilitate, 0) }}%</span>
                                </div>
                            </td>
                            
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('clase.show', $clasa) }}" class="text-blue-600 hover:text-blue-900">
                                    Vezi detalii →
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">Nu există clase.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Grafic comparativ -->
    <div class="mt-8 bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold mb-4">Comparație Medii pe Clase</h3>
        
        <div class="space-y-4">
            @foreach($clase as $clasa)
                @php
                    $totalElevi = $clasa->elevi->count();
                    $medieClasa = 0;
                    foreach($clasa->elevi as $elev) {
                        $medieClasa += $elev->medie_generala;
                    }
                    $medieClasa = $totalElevi > 0 ? $medieClasa / $totalElevi : 0;
                @endphp
                
                <div class="flex items-center">
                    <div class="w-32 text-sm font-medium">{{ $clasa->nume_complet }}</div>
                    
                    <div class="flex-1 mx-4">
                        <div class="bg-gray-200 rounded-full h-4">
                            <div class="bg-{{ $medieClasa >= 8 ? 'green' : ($medieClasa >= 5 ? 'yellow' : 'red') }}-500 h-4 rounded-full transition-all duration-500" 
                                 style="width: {{ min($medieClasa * 10, 100) }}%"></div>
                        </div>
                    </div>
                    
                    <div class="w-16 text-right font-bold {{ $medieClasa >= 8 ? 'text-green-600' : ($medieClasa >= 5 ? 'text-yellow-600' : 'text-red-600') }}">
                        {{ $medieClasa > 0 ? number_format($medieClasa, 2) : '-' }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@push('styles')
    <style>
        @media print {
            .sidebar { display: none; }
            .no-print { display: none; }
            main { margin-left: 0; max-width: 100%; }
        }
    </style>
@endpush
