<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, BelongsToMany, HasMany, HasOne};

class Maintenance_followup_doc extends Model
{
    protected $table = "maintenance_followup_doc";
    
    protected $fillable = ['maintenance_followup_id', 'name', 'path'];

    public function maintenance_followup(): BelongsTo
    {
        return $this->belongsTo(Maintenance_followup::class);
    }
}
