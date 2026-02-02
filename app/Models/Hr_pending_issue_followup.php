<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hr_pending_issue_followup extends Model
{
    use HasFactory;

    protected $table = 'hr_pending_issue_followup';
    
    protected $fillable = [
        'hr_pending_issue_id',
        'followup_date',
        'professional_id',
        'description'
    ];

    protected $casts = [
        'followup_date' => 'date',
    ];

    public function issue(): BelongsTo
    {
        return $this->belongsTo(Hr_pending_issue::class, 'hr_pending_issue_id');
    }

    public function professional(): BelongsTo
    {
        return $this->belongsTo(Professional::class, 'professional_id');
    }

    public function documents(): HasMany
    {
        return $this->hasMany(Hr_pending_issue_followup_document::class, 'hr_followup_id');
    }
}