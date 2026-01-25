<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; 
use Illuminate\Database\Eloquent\Relations\{BelongsTo, BelongsToMany, HasMany, HasOne};

class Professional extends Authenticatable 
{
    protected $table = "professionals";

    protected $fillable = ['center_id','name','surnames','username','password','phone_number','email_address','address','number_locker','occupation','clue_locker','link_status','status'];

    protected $hidden = ['password'];

    // Relacions
    public function center(): BelongsTo
    {
        return $this->belongsTo(Center::class);
    }

    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'professionals_courses')
            ->withPivot('start_date', 'end_date', 'certificate')
            ->withTimestamps();
    }

    public function uniforms(): HasMany
    {
        return $this->hasMany(Uniform::class);
    }

    public function managed_projects(): HasMany
    {
        return $this->HasMany(Project_comission::class, 'professional_manager_id');
    }
    public function monitorings(): HasMany
    {
        return $this->HasMany(Monitoring::class);
    }
    public function evaluation(): HasMany
    {
        return $this->hasMany(Evaluation::class, 'assessed_professional_id');
    }
    public function maintenance_followups(): HasMany
    {
        return $this->HasMany(Maintenance_followup::class);
    }
    public function recent_activities(): HasMany
    {
        return $this->HasMany(Recent_Activity::class);
    }
}
