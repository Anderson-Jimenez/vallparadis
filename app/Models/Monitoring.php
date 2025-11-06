<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, BelongsToMany, HasMany, HasOne};

class Monitoring extends Model
{
    use HasFactory;
    protected $table = "monitorings";


    protected $fillable = [
        'professional_id',
        'professional_monitoring_id',
        'type',
        'date',
        'issue',
        'comments',
    ];
     
    public function professional(): BelongsTo
    {
        return $this->belongsTo(Professional::class);
    }

}
