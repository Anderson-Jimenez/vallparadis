<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Center extends Model
{
    protected $table = "centers";

    public function professionals(): HasMany{
        return $this->hasMany(Professional::class);
    }

}
