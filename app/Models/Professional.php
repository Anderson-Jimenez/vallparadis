<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; 
use Illuminate\Database\Eloquent\Relations\{BelongsTo, BelongsToMany, HasMany, HasOne};

class Professional extends Authenticatable 
{
    protected $table = "professionals";

    protected $fillable = ['center_id','name','surnames','username','password','phone_number','email_address','address','number_locker','clue_locker','link_status'];

    protected $hidden = ['password'];

    // Relacions
    public function center(): BelongsTo
    {
        return $this->belongsTo(Center::class);
    }

    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class);
    }

    public function uniforms(): HasMany
    {
        return $this->hasMany(Uniform::class);
    }

    public function managed_projects(): HasMany
    {
        return $this->HasMany(Project_comission::class, 'professional_manager_id');
    }
}
