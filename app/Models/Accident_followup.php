<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, BelongsToMany, HasMany, HasOne};

class Accident_followup extends Model
{
    protected $table = "accidents_followup";

    protected $fillable = [
        'accident_id',
        'professional_id',
        'date',
        'issue',
        'description'
    ];

    public function professional(): BelongsTo
    {
        return $this->belongsTo(Professional::class);
    }

    public function accident(): BelongsTo
    {
        return $this->belongsTo(Accident::class);
    }
}
