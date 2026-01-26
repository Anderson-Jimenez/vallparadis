<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, BelongsToMany, HasMany, HasOne};

class Accident extends Model
{
    protected $table = "accidents";

    protected $fillable = [
        'registred_professional_id',
        'affected_professional_id',
        'issue','start_date',
        'end_date',
        'description',
        'status',
    ];

    public function center(): BelongsTo
    {
        return $this->belongsTo(Center::class);
    }

    public function affected_professional(): BelongsTo
    {
        return $this->belongsTo(Professional::class, 'affected_professional_id');
    }

    public function registered_professional(): BelongsTo
    {
        return $this->belongsTo(Professional::class, 'registered_professional_id');
    }

    public function accident_followups(): HasMany
    {
        return $this->hasMany(Accident_followup::class);
    }
    public function accident_doc(): HasMany
    {
        return $this->hasMany(Accident_doc::class);
    }
}
