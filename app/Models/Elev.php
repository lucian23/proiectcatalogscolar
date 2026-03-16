<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Elev extends Model
{
    use HasFactory;

    protected $table = 'elevi';

    protected $fillable = [
        'nume',
        'prenume',
        'email',
        'telefon',
        'data_nasterii',
        'numar_matricol',
        'clasa_id',
        'data_inscrierii',
        'activ',
        'observatii',
    ];

    protected $casts = [
        'data_nasterii' => 'date',
        'data_inscrierii' => 'date',
        'activ' => 'boolean',
    ];

    public function clasa(): BelongsTo
    {
        return $this->belongsTo(Clasa::class);
    }

    public function note(): HasMany
    {
        return $this->hasMany(Nota::class);
    }

    public function getNumeCompletAttribute(): string
    {
        return "{$this->nume} {$this->prenume}";
    }

    public function getMedieGeneralaAttribute(): float
    {
        $note = $this->note;
        if ($note->isEmpty()) {
            return 0;
        }
        return round($note->avg('nota'), 2);
    }
}
