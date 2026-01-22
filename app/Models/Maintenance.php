<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, BelongsToMany, HasMany, HasOne};

use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    protected $table = "maintenance";

    protected $fillable = ['center_id','name','start_date','manager','phone','email','description','status'];

    public function centers(): BelongsTo
    {
        return $this->belongsTo(Center::class);
    }

    public function maintenance_docs(): HasMany {
        return $this->hasMany(Maintenance_doc::class);
    }

    public function maintenance_followups(): HasMany
    {
        return $this->hasMany(Maintenance_followup::class);
    }
}
