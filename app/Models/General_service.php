<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class General_service extends Model
{
    protected $table = "general_services";

    protected $fillable = ['center_name','location','phone_number','email_address','status'];
    
    public function centers(): BelongsTo
    {
        return $this->belongsTo(Center::class);
    }
}
