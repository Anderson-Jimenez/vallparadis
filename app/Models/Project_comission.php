<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project_comission extends Model
{
    protected $table = "projects_comissions";

    public function centers(): BelongsTo {
        return $this->belongsTo(Center::class);
    }

    public function professionals(): HasOne {
        return $this->hasOne(Professional::class);
    }

    public function projects_comissions_documents(): HasMany {
        return $this->hasMany(Project_comission_document::class);
    }

}
