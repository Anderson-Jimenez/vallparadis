<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, BelongsToMany, HasMany, HasOne};

class General_service_followup extends Model
{
    protected $table = "general_services_followups";
    protected $fillable = [
        'general_service_id',
        'date',
        'issue',
        'comment',
    ];

    public function general_service(): BelongsTo
    {
        return $this->belongsTo(General_service::class);
    }
}
