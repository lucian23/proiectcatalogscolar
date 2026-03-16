<?php

namespace App\Http\Controllers;

use App\Models\Clasa;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ClasaController extends Controller
{
    public function index(): View
    {
        $clase = Clasa::withCount('elevi')->paginate(10);
        return view('clase.index', compact('clase'));
    }

    public function create(): View
    {
        return view('clase.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nume' => 'required|string|max:10',
            'an' => 'required|integer|min:1|max:12',
            'profil' => 'nullable|string|max:50',
            'an_scolar' => 'required|integer|min:2000|max:2100',
        ]);

        Clasa::create($validated);

        return redirect()->route('clase.index')->with('success', 'Clasa a fost creată cu succes!');
    }

    public function show(Clasa $clasa): View
    {
        $clasa->load(['elevi.note']);
        return view('clase.show', compact('clasa'));
    }

    public function edit(Clasa $clasa): View
    {
        return view('clase.edit', compact('clasa'));
    }

    public function update(Request $request, Clasa $clasa): RedirectResponse
    {
        $validated = $request->validate([
            'nume' => 'required|string|max:10',
            'an' => 'required|integer|min:1|max:12',
            'profil' => 'nullable|string|max:50',
            'an_scolar' => 'required|integer|min:2000|max:2100',
        ]);

        $clasa->update($validated);

        return redirect()->route('clase.index')->with('success', 'Clasa a fost actualizată cu succes!');
    }

    public function destroy(Clasa $clasa): RedirectResponse
    {
        $clasa->delete();
        return redirect()->route('clase.index')->with('success', 'Clasa a fost ștearsă cu succes!');
    }
}
