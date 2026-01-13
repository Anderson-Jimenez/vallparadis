<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, BelongsToMany, HasMany, HasOne};

class Supplementary_service_doc extends Model
{
    protected $table = "supplementaries_services_doc";
    protected $fillable = ['supplementaries_service_id', 'name', 'path'];

    public function supplementary_service(): BelongsTo
    {
        return $this->belongsTo(Supplementary_service::class);
    }
}
