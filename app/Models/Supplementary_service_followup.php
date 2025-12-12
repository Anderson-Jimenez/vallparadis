<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, BelongsToMany, HasMany, HasOne};

class Supplementary_service_followup extends Model
{
    protected $table = "supplementaries_services_followups";

    protected $fillable = [
        'supplementaries_service_id', // coincide con la migración
        'date',
        'issue',
        'comment',
    ];

    public function supplementary_service(): BelongsTo
    {
        return $this->belongsTo(Supplementary_service::class, 'supplementaries_service_id');
    }
}
