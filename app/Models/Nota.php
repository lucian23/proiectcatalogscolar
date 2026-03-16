<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Nota extends Model
{
    use HasFactory;

    protected $table = 'note';

    protected $fillable = [
        'elev_id',
        'materie_id',
        'profesor_id',
        'nota',
        'tip',
        'data',
        'observatii',
    ];

    protected $casts = [
        'nota' => 'decimal:2',
        'data' => 'date',
    ];

    public function elev(): BelongsTo
    {
        return $this->belongsTo(Elev::class);
    }

    public function materie(): BelongsTo
    {
        return $this->belongsTo(Materie::class);
    }

    public function profesor(): BelongsTo
    {
        return $this->belongsTo(Profesor::class);
    }
}
