@extends('layouts.app')

@section('title', 'Clase')
@section('header', 'Gestionare Clase')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Lista Claselor</h2>
        <a href="{{ route('clase.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
            <i class="fas fa-plus mr-2"></i> Adaugă Clasă
        </a>
    </div>
    
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nume</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">An</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Profil</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">An Școlar</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Elevi</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Acțiuni</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($clase as $clasa)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $clasa->nume }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $clasa->an }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $clasa->profil ?? '-' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $clasa->an_scolar }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    {{ $clasa->elevi_count }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('clase.show', $clasa->id) }}" class="text-blue-600 hover:text-blue-900 mr-3" title="Vezi detalii">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('clase.edit', $clasa->id) }}" class="text-yellow-600 hover:text-yellow-900 mr-3" title="Editează">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('clase.destroy', $clasa->id) }}" method="POST" class="inline" onsubmit="return confirm('Ești sigur că vrei să ștergi această clasă?');">
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
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                Nu există clase încă. <a href="{{ route('clase.create') }}" class="text-blue-600 hover:underline">Adaugă prima clasă</a>.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($clase->hasPages())
            <div class="px-6 py-4 border-t">
                {{ $clase->links() }}
            </div>
        @endif
    </div>
@endsection
