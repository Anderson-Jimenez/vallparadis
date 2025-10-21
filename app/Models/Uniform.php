<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, BelongsToMany, HasMany, HasOne};

class Uniform extends Model
{
    protected $table = "uniforms";
    protected $fillable = ['professional_id','shirt_size','trausers_size','shoes_size','renovation_date','docs_route'];

    public function professional(): BelongsTo {
        return $this->belongsTo(Professional::class);
    }
}
