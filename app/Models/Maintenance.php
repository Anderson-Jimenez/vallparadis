<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, BelongsToMany, HasMany, HasOne};

use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    protected $table = "maintenance";

    protected $fillable = ['center_id','start_date','description','manager','docs','status'];

    public function centers(): BelongsTo
    {
        return $this->belongsTo(Center::class);
    }

    public function maintenance_doc(): HasMany {
        return $this->hasMany(Maintenance_doc::class);
    }
}
