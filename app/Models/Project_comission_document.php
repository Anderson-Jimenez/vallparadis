<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, BelongsToMany, HasMany, HasOne};

class Project_comission_document extends Model
{
    protected $table = "projects_comissions_documents";

    public function projects_comissions(): BelongsTo {
        return $this->belongsTo(Project_comission::class);
    }
}
