<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Hr_pending_issue_document extends Model
{
    use HasFactory;

    protected $table = 'hr_pending_issue_documents';
    
    protected $fillable = [
        'hr_pending_issue_id',
        'path'
    ];

    public function issue(): BelongsTo
    {
        return $this->belongsTo(Hr_pending_issue::class, 'hr_pending_issue_id');
    }
}