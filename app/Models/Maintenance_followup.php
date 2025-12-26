<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, BelongsToMany, HasMany, HasOne};

class Maintenance_followup extends Model
{
    protected $table = "maintenance_followups";

    protected $fillable = ['maintenance_id','professional_id','date','description','docs'];

    public function professional(): BelongsTo
    {
        return $this->belongsTo(Professional::class);
    }

}
