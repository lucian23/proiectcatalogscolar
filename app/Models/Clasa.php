<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Clasa extends Model
{
    use HasFactory;

    protected $table = 'clase';

    protected $fillable = [
        'nume',
        'an',
        'profil',
        'an_scolar',
    ];

    public function elevi(): HasMany
    {
        return $this->hasMany(Elev::class);
    }

    public function getNumeCompletAttribute(): string
    {
        return "{$this->an}{$this->nume} - {$this->profil}";
    }
}
