<?php

namespace App\Http\Controllers;

use App\Models\Profesor;
use App\Models\Materie;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ProfesorController extends Controller
{
    public function index(): View
    {
        $profesori = Profesor::withCount('materii')->where('activ', true)->paginate(15);
        return view('profesori.index', compact('profesori'));
    }

    public function create(): View
    {
        $materii = Materie::all();
        return view('profesori.create', compact('materii'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nume' => 'required|string|max:100',
            'prenume' => 'required|string|max:100',
            'email' => 'required|email|unique:profesori',
            'telefon' => 'nullable|string|max:20',
            'grad_didactic' => 'nullable|string|max:50',
            'materii' => 'nullable|array',
            'materii.*' => 'exists:materii,id',
        ]);

        $profesor = Profesor::create($validated);
        
        if (isset($validated['materii'])) {
            $profesor->materii()->sync($validated['materii']);
        }

        return redirect()->route('profesori.index')->with('success', 'Profesorul a fost adăugat cu succes!');
    }

    public function show(Profesor $profesor): View
    {
        $profesor->load(['materii', 'note']);
        return view('profesori.show', compact('profesor'));
    }

    public function edit(Profesor $profesor): View
    {
        $materii = Materie::all();
        $profesor->load('materii');
        return view('profesori.edit', compact('profesor', 'materii'));
    }

    public function update(Request $request, Profesor $profesor): RedirectResponse
    {
        $validated = $request->validate([
            'nume' => 'required|string|max:100',
            'prenume' => 'required|string|max:100',
            'email' => 'required|email|unique:profesori,email,' . $profesor->id,
            'telefon' => 'nullable|string|max:20',
            'grad_didactic' => 'nullable|string|max:50',
            'activ' => 'boolean',
            'materii' => 'nullable|array',
            'materii.*' => 'exists:materii,id',
        ]);

        $profesor->update($validated);
        
        if (isset($validated['materii'])) {
            $profesor->materii()->sync($validated['materii']);
        }

        return redirect()->route('profesori.index')->with('success', 'Datele profesorului au fost actualizate!');
    }

    public function destroy(Profesor $profesor): RedirectResponse
    {
        $profesor->update(['activ' => false]);
        return redirect()->route('profesori.index')->with('success', 'Profesorul a fost dezactivat!');
    }
}
