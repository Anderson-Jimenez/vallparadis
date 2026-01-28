<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, BelongsToMany, HasMany, HasOne};
use Carbon\Carbon;

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

    public function registred_professional(): BelongsTo
    {
        return $this->belongsTo(Professional::class, 'registred_professional_id');
    }

    public function accident_followups(): HasMany
    {
        return $this->hasMany(Accident_followup::class);
    }
    public function accident_doc(): HasMany
    {
        return $this->hasMany(Accident_doc::class);
    }

    public function getDaysAttribute()
    {
        $start = strtotime($this->start_date);
        $end = $this->end_date ? strtotime($this->end_date) : time(); // hoy si no hay end_date

        $diffSeconds = $end - $start;
        $diffDays = ceil($diffSeconds / (60 * 60 * 24)); // segundos a días

        return $diffDays;
    }
}
