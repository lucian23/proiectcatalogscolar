@extends('layouts.app')

@section('title', 'Materii')
@section('header', 'Gestionare Materii')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Lista Materii</h2>
        <a href="{{ route('materii.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg flex items-center">
            <i class="fas fa-book-medical mr-2"></i> Adaugă Materie
        </a>
    </div>
    
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Cod</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nume</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Descriere</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Obligatorie</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Profesori</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Acțiuni</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($materii as $materie)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                    {{ $materie->cod }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $materie->nume }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-500 truncate max-w-xs" title="{{ $materie->descriere }}">
                                    {{ $materie->descriere ?? '-' }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                @if($materie->obligatorie)
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Da</span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">Opțional</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    {{ $materie->profesori_count }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('materii.show', $materie->id) }}" class="text-blue-600 hover:text-blue-900 mr-3" title="Vezi detalii">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('materii.edit', $materie->id) }}" class="text-yellow-600 hover:text-yellow-900 mr-3" title="Editează">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('materii.destroy', $materie->id) }}" method="POST" class="inline" onsubmit="return confirm('Ești sigur că vrei să ștergi această materie?');">
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
                                Nu există materii încă. <a href="{{ route('materii.create') }}" class="text-indigo-600 hover:underline">Adaugă prima materie</a>.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($materii->hasPages())
            <div class="px-6 py-4 border-t">
                {{ $materii->links() }}
            </div>
        @endif
    </div>
@endsection
