<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Professional extends Model
{
    protected $table = "professionals";
    
    public function centers(): BelongsTo {
        return $this->belongsTo(Center::class);
    }

    public function courses(): BelongsToMany {
        return $this->belongsToMany(Course::class);
    }

    public function uniforms(): HasMany {
        return $this->belongsTo(Uniform::class);
    }

    public function projects_comissions(): HasOne {
        return $this->hasOne(Project_comission::class);
    }
}
