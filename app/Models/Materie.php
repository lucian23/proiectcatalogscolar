<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Materie extends Model
{
    use HasFactory;

    protected $table = 'materii';

    protected $fillable = [
        'nume',
        'cod',
        'descriere',
        'obligatorie',
    ];

    protected $casts = [
        'obligatorie' => 'boolean',
    ];

    public function profesori(): BelongsToMany
    {
        return $this->belongsToMany(Profesor::class, 'materie_profesor');
    }

    public function note(): HasMany
    {
        return $this->hasMany(Nota::class);
    }
}
