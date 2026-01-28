<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, BelongsToMany, HasMany, HasOne};

class Accident_doc extends Model
{
    protected $table = "accidents_doc";

    protected $fillable = [
        'accident_id',
        'name',
        'path'
    ];

    public function accident(): BelongsTo
    {
        return $this->belongsTo(Accident::class);
    }
}
