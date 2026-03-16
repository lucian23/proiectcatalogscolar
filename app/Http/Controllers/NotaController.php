<?php

namespace App\Http\Controllers;

use App\Models\Nota;
use App\Models\Elev;
use App\Models\Materie;
use App\Models\Profesor;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class NotaController extends Controller
{
    public function index(): View
    {
        $note = Nota::with(['elev', 'materie', 'profesor'])->latest()->paginate(20);
        return view('note.index', compact('note'));
    }

    public function create(): View
    {
        $elevi = Elev::where('activ', true)->get();
        $materii = Materie::all();
        $profesori = Profesor::where('activ', true)->get();
        return view('note.create', compact('elevi', 'materii', 'profesori'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'elev_id' => 'required|exists:elevi,id',
            'materie_id' => 'required|exists:materii,id',
            'profesor_id' => 'required|exists:profesori,id',
            'nota' => 'required|numeric|min:1|max:10',
            'tip' => 'required|in:curenta,teza,recuperare',
            'data' => 'required|date',
            'observatii' => 'nullable|string',
        ]);

        Nota::create($validated);

        return redirect()->route('note.index')->with('success', 'Nota a fost adăugată cu succes!');
    }

    public function show(Nota $nota): View
    {
        $nota->load(['elev', 'materie', 'profesor']);
        return view('note.show', compact('nota'));
    }

    public function edit(Nota $nota): View
    {
        $elevi = Elev::where('activ', true)->get();
        $materii = Materie::all();
        $profesori = Profesor::where('activ', true)->get();
        return view('note.edit', compact('nota', 'elevi', 'materii', 'profesori'));
    }

    public function update(Request $request, Nota $nota): RedirectResponse
    {
        $validated = $request->validate([
            'elev_id' => 'required|exists:elevi,id',
            'materie_id' => 'required|exists:materii,id',
            'profesor_id' => 'required|exists:profesori,id',
            'nota' => 'required|numeric|min:1|max:10',
            'tip' => 'required|in:curenta,teza,recuperare',
            'data' => 'required|date',
            'observatii' => 'nullable|string',
        ]);

        $nota->update($validated);

        return redirect()->route('note.index')->with('success', 'Nota a fost actualizată!');
    }

    public function destroy(Nota $nota): RedirectResponse
    {
        $nota->delete();
        return redirect()->route('note.index')->with('success', 'Nota a fost ștearsă!');
    }
}
