<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, BelongsToMany, HasMany, HasOne};

class Uniform extends Model
{
    protected $table = "uniforms";

    public function professionals(): BelongsTo {
        return $this->belongsTo(Professional::class);
    }
}
