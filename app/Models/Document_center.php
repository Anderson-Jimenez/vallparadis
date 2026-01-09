<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Document_center extends Model
{
    protected $table = 'documents_center';

    protected $fillable = [
        'document_center_info_id',
        'path',
    ];

    public function document_center_info(): BelongsTo {
        return $this->belongsTo(Document_center_info::class, 'document_center_info_id');
    }
}
