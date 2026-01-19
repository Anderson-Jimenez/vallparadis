<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, BelongsToMany, HasMany, HasOne};

class Supplementary_service extends Model
{
    protected $table = "supplementaries_services";

    protected $fillable = [
        'center_id',
        'type',
        'start_date',
        'manager',
        'email_address',
        'phone_number',
        'comments',
        'status'
    ];

    public function centers(): BelongsTo
    {
        return $this->belongsTo(Center::class);
    }

    public function supplementary_service_followups(): HasMany
    {
        return $this->hasMany(Supplementary_service_followup::class, 'supplementaries_service_id');
    }
    public function supplementary_service_doc(): HasMany {
        return $this->hasMany(Supplementary_service_doc::class);
    }
}
