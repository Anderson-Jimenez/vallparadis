<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, BelongsToMany, HasMany, HasOne};

class Maintenance_doc extends Model
{
    protected $table = "maintenance_doc";
    
    protected $fillable = ['maintenance_id', 'name', 'path','status'];

    public function maintenance(): BelongsTo
    {
        return $this->belongsTo(Maintenance::class);
    }
}
