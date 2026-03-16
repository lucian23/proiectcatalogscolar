@extends('layouts.app')

@section('title', 'Raport Elev - ' . $elev->nume_complet)
@section('header', 'Raport Complet: ' . $elev->nume_complet)

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <a href="{{ route('elevi.show', $elev) }}" class="text-blue-600 hover:text-blue-800">
            <i class="fas fa-arrow-left mr-2"></i> Înapoi la fișa elevului
        </a>
        
        <button onclick="window.print()" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded flex items-center">
            <i class="fas fa-print mr-2"></i> Tipărește Raportul
        </button>
    </div>
    
    <!-- Header Raport -->
    <div class="bg-white rounded-lg shadow p-8 mb-6">
        <div class="text-center border-b pb-6">
            <h1 class="text-2xl font-bold text-gray-800">RAPORT ȘCOLAR</h1>
            <p class="text-gray-600 mt-2">Anul Școlar {{ $elev->clasa->an_scolar ?? date('Y') }}</p>
        </div>
        
        <div class="grid grid-cols-2 gap-8 mt-6">
            <div>
                <h4 class="font-semibold text-gray-700 mb-3">Date Elev:</h4>
                <p><span class="text-gray-600">Nume:</span> <strong>{{ $elev->nume_complet }}</strong></p>
                <p><span class="text-gray-600">Nr. Matricol:</span> <strong>{{ $elev->numar_matricol }}</strong></p>
                <p><span class="text-gray-600">Clasa:</span> <strong>{{ $elev->clasa->nume_complet ?? 'N/A' }}</strong></p>
            </div>
            
            <div class="text-right">
                <h4 class="font-semibold text-gray-700 mb-3">Situație Generală:</h4>
                <p><span class="text-gray-600">Medie Generală:</span> 
                    <strong class="text-2xl {{ $elev->medie_generala >= 8 ? 'text-green-600' : ($elev->medie_generala >= 5 ? 'text-yellow-600' : 'text-red-600') }}">
                        {{ $elev->medie_generala > 0 ? number_format($elev->medie_generala, 2) : '-' }}
                    </strong>
                </p>
                <p><span class="text-gray-600">Total Materii:</span> <strong>{{ $medii_materii->count() }}</strong></p>
                <p><span class="text-gray-600">Total Note:</span> <strong>{{ $elev->note->count() }}</strong></p>
            </div>
        </div>
    </div>
    
    <!-- Situație pe Materii -->
    <div class="bg-white rounded-lg shadow overflow-hidden mb-6">
        <div class="px-6 py-4 border-b">
            <h3 class="text-lg font-semibold">Situație pe Materii</h3>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Materie</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Note Curentă</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Teză</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Medie</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($medii_materii as $item)
                        @php
                            $medie = $item['medie'];
                            $note = $item['note'];
                            $teza = $note->where('tip', 'teza')->first();
                            $noteCurente = $note->where('tip', 'curenta');
                        @endphp
                        
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap font-medium">{{ $item['materie'] }}</td>
                            
                            <td class="px-6 py-4 text-center">
                                @foreach($noteCurente as $nota)
                                    <span class="inline-block px-2 py-1 mx-1 text-xs rounded-full {{ $nota->nota >= 8 ? 'bg-green-100 text-green-800' : ($nota->nota >= 5 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                        {{ $nota->nota }}
                                    </span>
                                @endforeach
                            </td>
                            
                            <td class="px-6 py-4 text-center">
                                @if($teza)
                                    <span class="px-2 py-1 text-xs rounded-full bg-purple-100 text-purple-800 font-bold">{{ $teza->nota }}</span>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            
                            <td class="px-6 py-4 text-center font-bold {{ $medie >= 8 ? 'text-green-600' : ($medie >= 5 ? 'text-yellow-600' : 'text-red-600') }}">
                                {{ number_format($medie, 2) }}
                            </td>
                            
                            <td class="px-6 py-4 text-center">
                                @if($medie >= 8)
                                    <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Excelent</span>
                                @elseif($medie >= 6)
                                    <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">Bine</span>
                                @elseif($medie >= 5)
                                    <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">Suficient</span>
                                @else
                                    <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800">Insuficient</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">Nu există note pentru acest elev.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Semnături -->
    <div class="bg-white rounded-lg shadow p-8 mt-6">
        <div class="grid grid-cols-2 gap-8 mt-8 pt-8 border-t">
            <div class="text-center">
                <p class="mb-8">&nbsp;</p>
                <div class="border-t border-gray-400 pt-2">
                    <p class="font-medium">Diriginte</p>
                </div>
            </div>
            
            <div class="text-center">
                <p class="mb-8">&nbsp;</p>
                <div class="border-t border-gray-400 pt-2">
                    <p class="font-medium">Părinte/Tutore</p>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-8 text-sm text-gray-500">
            <p>Document generat electronic din Catalogul Școlar Online</p>
            <p>Data: {{ now()->format('d.m.Y H:i') }}</p>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        @media print {
            .sidebar { display: none !important; }
            .no-print { display: none !important; }
            main { margin-left: 0 !important; max-width: 100% !important; }
            .shadow { box-shadow: none !important; }
            button { display: none !important; }
            a { text-decoration: none !important; color: black !important; }
        }
    </style>
@endpush
