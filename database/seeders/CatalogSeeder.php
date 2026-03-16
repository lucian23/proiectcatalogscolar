<?php

namespace Database\Seeders;

use App\Models\Clasa;
use App\Models\Elev;
use App\Models\Materie;
use App\Models\Profesor;
use App\Models\Nota;
use Illuminate\Database\Seeder;

class CatalogSeeder extends Seeder
{
    public function run(): void
    {
        // Creăm clase
        $clase = [
            ['nume' => 'A', 'an' => 9, 'profil' => 'Real', 'an_scolar' => 2025],
            ['nume' => 'B', 'an' => 9, 'profil' => 'Uman', 'an_scolar' => 2025],
            ['nume' => 'C', 'an' => 10, 'profil' => 'Real', 'an_scolar' => 2025],
            ['nume' => 'D', 'an' => 10, 'profil' => 'Uman', 'an_scolar' => 2025],
            ['nume' => 'E', 'an' => 11, 'profil' => 'Științe', 'an_scolar' => 2025],
        ];

        foreach ($clase as $clasa) {
            Clasa::create($clasa);
        }

        // Creăm materii
        $materii = [
            ['nume' => 'Matematică', 'cod' => 'MAT', 'obligatorie' => true],
            ['nume' => 'Limba Română', 'cod' => 'ROM', 'obligatorie' => true],
            ['nume' => 'Limba Engleză', 'cod' => 'ENG', 'obligatorie' => true],
            ['nume' => 'Fizică', 'cod' => 'FIZ', 'obligatorie' => true],
            ['nume' => 'Chimie', 'cod' => 'CHI', 'obligatorie' => true],
            ['nume' => 'Biologie', 'cod' => 'BIO', 'obligatorie' => true],
            ['nume' => 'Istorie', 'cod' => 'IST', 'obligatorie' => true],
            ['nume' => 'Geografie', 'cod' => 'GEO', 'obligatorie' => true],
            ['nume' => 'Informatică', 'cod' => 'INFO', 'obligatorie' => false],
            ['nume' => 'Educație Fizică', 'cod' => 'EDF', 'obligatorie' => true],
        ];

        foreach ($materii as $materie) {
            Materie::create($materie);
        }

        // Creăm profesori
        $profesori = [
            ['nume' => 'Popescu', 'prenume' => 'Ion', 'email' => 'ion.popescu@scoala.ro', 'grad_didactic' => 'I'],
            ['nume' => 'Ionescu', 'prenume' => 'Maria', 'email' => 'maria.ionescu@scoala.ro', 'grad_didactic' => 'II'],
            ['nume' => 'Georgescu', 'prenume' => 'Andrei', 'email' => 'andrei.georgescu@scoala.ro', 'grad_didactic' => 'Definitivat'],
            ['nume' => 'Marin', 'prenume' => 'Elena', 'email' => 'elena.marin@scoala.ro', 'grad_didactic' => 'I'],
            ['nume' => 'Dumitrescu', 'prenume' => 'Radu', 'email' => 'radu.dumitrescu@scoala.ro', 'grad_didactic' => 'II'],
        ];

        foreach ($profesori as $profesor) {
            Profesor::create($profesor);
        }

        // Asociem profesori cu materii
        Profesor::find(1)->materii()->sync([1, 4]); // Popescu - Matematică, Fizică
        Profesor::find(2)->materii()->sync([2]);    // Ionescu - Română
        Profesor::find(3)->materii()->sync([3, 9]); // Georgescu - Engleză, Informatică
        Profesor::find(4)->materii()->sync([5, 6]); // Marin - Chimie, Biologie
        Profesor::find(5)->materii()->sync([7, 8]); // Dumitrescu - Istorie, Geografie

        // Creăm elevi
        $eleviClasaA = [
            ['nume' => 'Andrei', 'prenume' => 'Mihai', 'numar_matricol' => '9001'],
            ['nume' => 'Barbu', 'prenume' => 'Ana', 'numar_matricol' => '9002'],
            ['nume' => 'Cojocaru', 'prenume' => 'Alexandru', 'numar_matricol' => '9003'],
            ['nume' => 'Dobre', 'prenume' => 'Ioana', 'numar_matricol' => '9004'],
            ['nume' => 'Enache', 'prenume' => 'Cristian', 'numar_matricol' => '9005'],
        ];

        $clasaA = Clasa::find(1);
        foreach ($eleviClasaA as $elev) {
            Elev::create(array_merge($elev, [
                'clasa_id' => $clasaA->id,
                'email' => strtolower($elev['prenume'] . '.' . $elev['nume']) . '@elev.scoala.ro',
            ]));
        }

        // Adăugăm note pentru elevi
        $elevi = Elev::all();
        $materiiIds = Materie::pluck('id');
        $profesoriIds = Profesor::pluck('id');

        foreach ($elevi as $elev) {
            foreach ($materiiIds as $materieId) {
                // Adăugăm 2-3 note pentru fiecare materie
                $nrNote = rand(2, 3);
                for ($i = 0; $i < $nrNote; $i++) {
                    Nota::create([
                        'elev_id' => $elev->id,
                        'materie_id' => $materieId,
                        'profesor_id' => $profesoriIds->random(),
                        'nota' => rand(50, 100) / 10, // Note între 5.0 și 10.0
                        'tip' => $i === 0 ? 'teza' : 'curenta',
                        'data' => now()->subDays(rand(1, 60)),
                    ]);
                }
            }
        }
    }
}
