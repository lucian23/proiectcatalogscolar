@extends('layouts.app')

@section('title', 'Profesori')
@section('header', 'Gestionare Profesori')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Lista Profesori</h2>
        <a href="{{ route('profesori.create') }}" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg flex items-center">
            <i class="fas fa-user-tie mr-2"></i> Adaugă Profesor
        </a>
    </div>
    
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nume</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Contact</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Grad Didactic</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Materii</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Acțiuni</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($profesori as $profesor)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $profesor->nume_complet }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $profesor->email }}</div>
                                @if($profesor->telefon)
                                    <div class="text-sm text-gray-500">{{ $profesor->telefon }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
                                    {{ $profesor->grad_didactic ?? 'N/A' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    {{ $profesor->materii_count }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('profesori.show', $profesor) }}" class="text-blue-600 hover:text-blue-900 mr-3" title="Vezi detalii">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('profesori.edit', $profesor) }}" class="text-yellow-600 hover:text-yellow-900 mr-3" title="Editează">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('profesori.destroy', $profesor) }}" method="POST" class="inline" onsubmit="return confirm('Ești sigur că vrei să dezactivezi acest profesor?');">
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
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                Nu există profesori încă. <a href="{{ route('profesori.create') }}" class="text-purple-600 hover:underline">Adaugă primul profesor</a>.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($profesori->hasPages())
            <div class="px-6 py-4 border-t">
                {{ $profesori->links() }}
            </div>
        @endif
    </div>
@endsection
