<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, BelongsToMany, HasMany, HasOne};

class Course extends Model
{
    protected $table = "courses";

    protected $fillable = ['center_id','code_forcem','hours','type','mode','training_name','status'];

    public function centers(): BelongsTo
    {
        return $this->belongsTo(Center::class);
    }

    public function professionals(): BelongsToMany
    {
        return $this->belongsToMany(Professional::class, 'professionals_courses')
            ->withPivot('start_date', 'end_date', 'certificate')
            ->withTimestamps();
    }
}
