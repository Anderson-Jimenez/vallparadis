<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, BelongsToMany, HasMany, HasOne};


class Evaluation extends Model
{
    protected $fillable = [
        'evaluator_id',
        'assessed_professional_id',
        'evaluation_date',
        'average_score',
    ];

    public function evaluator(): BelongsTo
    {
        return $this->belongsTo(Professional::class, 'evaluator_id');
    }

    public function assessed(): BelongsTo
    {
        return $this->belongsTo(Professional::class, 'assessed_professional_id');
    }

    public function results(): HasOne
    {
        return $this->hasOne(EvaluationResult::class);
    }
}