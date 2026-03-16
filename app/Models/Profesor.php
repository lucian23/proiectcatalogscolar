<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Profesor extends Model
{
    use HasFactory;

    protected $table = 'profesori';

    protected $fillable = [
        'nume',
        'prenume',
        'email',
        'telefon',
        'grad_didactic',
        'activ',
    ];

    protected $casts = [
        'activ' => 'boolean',
    ];

    public function materii(): BelongsToMany
    {
        return $this->belongsToMany(Materie::class, 'materie_profesor');
    }

    public function note(): HasMany
    {
        return $this->hasMany(Nota::class);
    }

    public function getNumeCompletAttribute(): string
    {
        return "{$this->nume} {$this->prenume}";
    }
}
