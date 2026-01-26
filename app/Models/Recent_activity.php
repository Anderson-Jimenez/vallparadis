<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, BelongsToMany, HasMany, HasOne};

class Recent_activity extends Model
{
    protected $table = "recent_activity";

    protected $fillable = ['center_id','professional_id','type','description'];

    public function centers(): BelongsTo
    {
        return $this->belongsTo(Center::class);
    }

    public function professional(): BelongsTo
    {
        return $this->belongsTo(Professional::class);
    }

}
