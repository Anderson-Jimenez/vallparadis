<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Professional extends Model
{
    protected $table = "professionals";
    public function center(): BelongsTo {
        return $this->belongsTo(Center::class);
    }

}
