<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Professional_doc extends Model
{
    protected $table = "professional_doc";
    
    protected $fillable = ['professional_id', 'type', 'name', 'path'];

    public function professional(): BelongsTo
    {
        return $this->belongsTo(Professional::class);
    }
}
