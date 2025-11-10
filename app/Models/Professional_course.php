<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Professional_course extends Model
{
    protected $table = 'professionals_courses';
    
    protected $fillable = ['professional_id','course_id','start_date','end_date','certificate'];
}
