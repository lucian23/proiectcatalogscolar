<?php

namespace App\Http\Controllers;

use App\Models\Materie;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class MaterieController extends Controller
{
    public function index(): View
    {
        $materii = Materie::withCount('profesori')->paginate(15);
        return view('materii.index', compact('materii'));
    }

    public function create(): View
    {
        return view('materii.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nume' => 'required|string|max:100',
            'cod' => 'required|string|max:10|unique:materii',
            'descriere' => 'nullable|string',
            'obligatorie' => 'boolean',
        ]);

        Materie::create($validated);

        return redirect()->route('materii.index')->with('success', 'Materia a fost adăugată cu succes!');
    }

    public function show(Materie $materie): View
    {
        $materie->load(['profesori', 'note']);
        return view('materii.show', compact('materie'));
    }

    public function edit(Materie $materie): View
    {
        return view('materii.edit', compact('materie'));
    }

    public function update(Request $request, Materie $materie): RedirectResponse
    {
        $validated = $request->validate([
            'nume' => 'required|string|max:100',
            'cod' => 'required|string|max:10|unique:materii,cod,' . $materie->id,
            'descriere' => 'nullable|string',
            'obligatorie' => 'boolean',
        ]);

        $materie->update($validated);

        return redirect()->route('materii.index')->with('success', 'Materia a fost actualizată!');
    }

    public function destroy(Materie $materie): RedirectResponse
    {
        $materie->delete();
        return redirect()->route('materii.index')->with('success', 'Materia a fost ștearsă!');
    }
}
