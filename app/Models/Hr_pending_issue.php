<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Hr_pending_issue extends Model
{
    use HasFactory;

    protected $table = 'hr_pending_issue';
    
    protected $fillable = [
        'center_id',
        'opened_at',
        'affected_professional_id',
        'description',
        'registered_by_professional_id',
        'derived_to_professional_id',
        'status',
    ];

    protected $casts = [
        'opened_at' => 'date',
    ];

    public function center(): BelongsTo
    {
        return $this->belongsTo(Center::class, 'center_id');
    }

    public function affected_professional(): BelongsTo
    {
        return $this->belongsTo(Professional::class, 'affected_professional_id');
    }

    public function registered_by_professional(): BelongsTo
    {
        return $this->belongsTo(Professional::class, 'registered_by_professional_id');
    }

    public function derived_to_professional(): BelongsTo
    {
        return $this->belongsTo(Professional::class, 'derived_to_professional_id');
    }

    public function documents(): HasMany
    {
        return $this->hasMany(Hr_pending_issue_document::class, 'hr_pending_issue_id');
    }

    public function followups(): HasMany
    {
        return $this->hasMany(Hr_pending_issue_followup::class, 'hr_pending_issue_id');
    }
}