<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, BelongsToMany, HasMany, HasOne};

class Maintenance_followup extends Model
{
    protected $table = "maintenance_followups";

    protected $fillable = ['maintenance_id','professional_id','date','description'];

    public function professional(): BelongsTo
    {
        return $this->belongsTo(Professional::class);
    }

    public function maintenance_followup_doc(): HasMany {
        return $this->hasMany(Maintenance_followup_doc::class);
    }

}
