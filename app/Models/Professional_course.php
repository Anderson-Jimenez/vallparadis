<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, BelongsToMany, HasMany, HasOne};

class Professional_course extends Model
{
    protected $table = 'professionals_courses';
    
    protected $fillable = ['professional_id','course_id','start_date','end_date','certificate'];

    public function professional(): BelongsTo
    {
        return $this->belongsTo(Professional::class);
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
