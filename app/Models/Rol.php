<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, BelongsToMany, HasMany, HasOne};

class Rol extends Model
{
    protected $table = "rols";

    protected $fillable = [
        'center_id',
        'role',
        'power'
    ];

    public function center(): BelongsTo
    {
        return $this->belongsTo(Center::class);
    }

    public function professionals(): HasMany
    {
        return $this->hasMany(Professional::class, 'role_id');
    }
}
