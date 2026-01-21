<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, BelongsToMany, HasMany, HasOne};

class Hr_pending_issue_followup_document extends Model
{
    protected $table = 'hr_pending_issue_followup_documents';
    
    protected $fillable = [
        'hr_issue_followup_id',
        'path',
    ];

    public function followup(): BelongsTo
    {
        return $this->belongsTo(Hr_pending_issue_followup::class, 'hr_issue_followup_id');
    }
}
