<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;

    protected $table = 'tenants'; 

    protected $fillable = [
        'landlord_id', 'tenant_name', 'email', 'password', 'contact_info', 'profile_picture'
    ];

    public function landlord()
    {
        return $this->belongsTo('App\Models\Landlord', 'landlord_id');
    }
}
