<?php

namespace App\Http\Controllers;

use App\Models\Elev;
use App\Models\Clasa;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ElevController extends Controller
{
    public function index(): View
    {
        $elevi = Elev::with('clasa')->where('activ', true)->paginate(15);
        return view('elevi.index', compact('elevi'));
    }

    public function create(): View
    {
        $clase = Clasa::all();
        return view('elevi.create', compact('clase'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nume' => 'required|string|max:100',
            'prenume' => 'required|string|max:100',
            'email' => 'nullable|email|unique:elevi',
            'telefon' => 'nullable|string|max:20',
            'data_nasterii' => 'nullable|date',
            'numar_matricol' => 'required|string|unique:elevi',
            'clasa_id' => 'required|exists:clase,id',
            'observatii' => 'nullable|string',
        ]);

        Elev::create($validated);

        return redirect()->route('elevi.index')->with('success', 'Elevul a fost înscris cu succes!');
    }

    public function show(Elev $elev): View
    {
        $elev->load(['clasa', 'note.materie', 'note.profesor']);
        return view('elevi.show', compact('elev'));
    }

    public function edit(Elev $elev): View
    {
        $clase = Clasa::all();
        return view('elevi.edit', compact('elev', 'clase'));
    }

    public function update(Request $request, Elev $elev): RedirectResponse
    {
        $validated = $request->validate([
            'nume' => 'required|string|max:100',
            'prenume' => 'required|string|max:100',
            'email' => 'nullable|email|unique:elevi,email,' . $elev->id,
            'telefon' => 'nullable|string|max:20',
            'data_nasterii' => 'nullable|date',
            'numar_matricol' => 'required|string|unique:elevi,numar_matricol,' . $elev->id,
            'clasa_id' => 'required|exists:clase,id',
            'activ' => 'boolean',
            'observatii' => 'nullable|string',
        ]);

        $elev->update($validated);

        return redirect()->route('elevi.index')->with('success', 'Datele elevului au fost actualizate!');
    }

    public function destroy(Elev $elev): RedirectResponse
    {
        $elev->update(['activ' => false]);
        return redirect()->route('elevi.index')->with('success', 'Elevul a fost dezactivat!');
    }
}
