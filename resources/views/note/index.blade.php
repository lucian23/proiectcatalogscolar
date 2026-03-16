@extends('layouts.app')

@section('title', 'Note')
@section('header', 'Gestionare Note')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Catalog Note</h2>
        <a href="{{ route('note.create') }}" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg flex items-center">
            <i class="fas fa-plus-circle mr-2"></i> Adaugă Notă
        </a>
    </div>
    
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Data</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Elev</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Materie</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Profesor</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Tip</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Notă</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Acțiuni</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($note as $nota)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $nota->data->format('d.m.Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $nota->elev->nume_complet ?? 'N/A' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $nota->materie->nume ?? 'N/A' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-500">{{ $nota->profesor->nume_complet ?? 'N/A' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
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
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $tipColors[$nota->tip] ?? 'bg-gray-100' }}">
                                    {{ $tipLabels[$nota->tip] ?? $nota->tip }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                @php
                                    $culoare = $nota->nota >= 8 ? 'green' : ($nota->nota >= 5 ? 'yellow' : 'red');
                                @endphp
                                <span class="px-3 py-1 inline-flex text-sm font-bold rounded-full bg-{{ $culoare }}-100 text-{{ $culoare }}-800">
                                    {{ $nota->nota }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('note.show', $nota->id) }}" class="text-blue-600 hover:text-blue-900 mr-3" title="Vezi detalii">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('note.edit', $nota->id) }}" class="text-yellow-600 hover:text-yellow-900 mr-3" title="Editează">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('note.destroy', $nota->id) }}" method="POST" class="inline" onsubmit="return confirm('Ești sigur că vrei să ștergi această notă?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" title="Șterge">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                Nu există note încă. <a href="{{ route('note.create') }}" class="text-red-600 hover:underline">Adaugă prima notă</a>.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($note->hasPages())
            <div class="px-6 py-4 border-t">
                {{ $note->links() }}
            </div>
        @endif
    </div>
@endsection
