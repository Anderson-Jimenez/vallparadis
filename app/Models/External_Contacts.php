<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class External_Contacts extends Model
{    
    use HasFactory;
    protected $table = "externals_contacts";

    protected $fillable = ['name','type','purpose_type','purpose','origin_type','organization','manager','phone_numer','email_address','comments'];

}
