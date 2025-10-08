<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Uniform extends Model
{
    protected $table = "uniforms";

    public function professionals(): BelongsTo {
        return $this->belongsTo(Professional::class);
    }
}
