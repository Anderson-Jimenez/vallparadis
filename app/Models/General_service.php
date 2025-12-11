<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, BelongsToMany, HasMany, HasOne};

class General_service extends Model
{
    protected $table = "general_services";

    protected $fillable = [
        'center_id',
        'type',
        'manager',
        'contact',
        'staff',
        'schedule',
    ];
    
    public function centers(): BelongsTo
    {
        return $this->belongsTo(Center::class);
    }

    public function general_services_followups(): HasMany {
         return $this->hasMany(General_service_followup::class);
    }
}
