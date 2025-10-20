<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, BelongsToMany, HasMany, HasOne};

class Center extends Model
{
    protected $table = "centers";

    protected $fillable = ['center_name','location','phone_number','email_address','status'];

    public function professionals(): HasMany {
        return $this->hasMany(Professional::class);
    }

    public function projects_comissions(): HasMany {
        return $this->hasMany(Project_comission::class);
    }

}
