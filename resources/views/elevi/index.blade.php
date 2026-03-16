@extends('layouts.app')

@section('title', 'Elevi')
@section('header', 'Gestionare Elevi')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Lista Elevi</h2>
        <a href="{{ route('elevi.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg flex items-center">
            <i class="fas fa-user-plus mr-2"></i> Înscrie Elev
        </a>
    </div>
    
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nr. Matricol</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nume Complet</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Clasă</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Contact</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Medie</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Acțiuni</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($elevi as $elev)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $elev->numar_matricol }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $elev->nume_complet }}</div>
                                @if($elev->email)
                                    <div class="text-sm text-gray-500">{{ $elev->email }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    {{ $elev->clasa->nume_complet ?? 'N/A' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $elev->telefon ?? '-' }}
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
                                <a href="{{ route('elevi.show', $elev->id) }}" class="text-blue-600 hover:text-blue-900 mr-3" title="Vezi detalii">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('elevi.edit', $elev->id) }}" class="text-yellow-600 hover:text-yellow-900 mr-3" title="Editează">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('elevi.destroy', $elev->id) }}" method="POST" class="inline" onsubmit="return confirm('Ești sigur că vrei să dezactivezi acest elev?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" title="Dezactivează">
                                        <i class="fas fa-user-slash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                Nu există elevi încă. <a href="{{ route('elevi.create') }}" class="text-green-600 hover:underline">Înscrie primul elev</a>.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($elevi->hasPages())
            <div class="px-6 py-4 border-t">
                {{ $elevi->links() }}
            </div>
        @endif
    </div>
@endsection
