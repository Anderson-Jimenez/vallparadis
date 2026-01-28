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

    public function courses(): HasMany {
        return $this->hasMany(Course::class);
    }

    public function general_services(): HasMany {
        return $this->hasMany(General_service::class);
    }
    public function documents_center_info(): HasMany {
        return $this->hasMany(Document_center_info::class);
    }
    public function hr_pending_issues(): HasMany
    {
        return $this->hasMany(Hr_pending_issue::class, 'center_id');
    }
    public function recent_activities(): HasMany {
        return $this->hasMany(Recent_activity::class);
    }

    public function accidents(): HasMany {
        return $this->hasMany(Accident::class);
    }

}
