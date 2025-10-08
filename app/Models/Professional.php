<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Professional extends Model
{
    protected $table = "professionals";
    
    public function center(): BelongsTo {
        return $this->belongsTo(Center::class);
    }

    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class);
    }

        public function uniforms(): HasMany {
        return $this->belongsTo(Uniform::class);
    }


}
