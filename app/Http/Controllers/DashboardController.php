<?php

namespace App\Http\Controllers;

use App\Models\Clasa;
use App\Models\Elev;
use App\Models\Materie;
use App\Models\Profesor;
use App\Models\Nota;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $statistici = [
            'total_clase' => Clasa::count(),
            'total_elevi' => Elev::where('activ', true)->count(),
            'total_materii' => Materie::count(),
            'total_profesori' => Profesor::where('activ', true)->count(),
            'total_note' => Nota::count(),
        ];

        $clase = Clasa::withCount('elevi')->get();
        $elevi_recenți = Elev::with('clasa')->latest()->take(5)->get();
        $note_recenți = Nota::with(['elev', 'materie'])->latest()->take(5)->get();

        return view('dashboard.index', compact('statistici', 'clase', 'elevi_recenți', 'note_recenți'));
    }

    public function raportClase(): View
    {
        $clase = Clasa::with(['elevi.note'])->get();
        return view('rapoarte.clase', compact('clase'));
    }

    public function raportElev(Elev $elev): View
    {
        $elev->load(['clasa', 'note.materie', 'note.profesor']);
        
        // Calculăm mediile pe materii
        $medii_materii = $elev->note
            ->groupBy('materie_id')
            ->map(function ($note) {
                return [
                    'materie' => $note->first()->materie->nume,
                    'medie' => round($note->avg('nota'), 2),
                    'note' => $note,
                ];
            });

        return view('rapoarte.elev', compact('elev', 'medii_materii'));
    }
}
