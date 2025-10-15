<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, BelongsToMany, HasMany, HasOne};

class Project_comission extends Model
{
    protected $table = "projects_comissions";

    public function center(): BelongsTo {
        return $this->belongsTo(Center::class);
    }

    public function manager(): BelongsTo {
        return $this->belongsTo(Professional::class, 'professional_manager_id');
    }

    public function projects_comissions_documents(): HasMany {
        return $this->hasMany(Project_comission_document::class);
    }

}
