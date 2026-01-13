<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Document_center_info extends Model
{
    use HasFactory;

    protected $table = 'documents_center_info';

    protected $fillable = [
        'type',
        'date',
        'description',
        'professional_id',
        'center_id',
    ];

    public function center(): BelongsTo {
        return $this->belongsTo(Center::class);
    }
    public function professional(): BelongsTo
    {
        return $this->belongsTo(Professional::class);
    }

    public function documents_center(): HasMany
    {
        return $this->hasMany(Document_center::class, 'document_center_info_id');
    }
}
