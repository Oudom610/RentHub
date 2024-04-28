<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Landlord extends Model implements AuthenticatableContract
{
    use HasFactory, Authenticatable;

    protected $fillable = [
        'landlord_name',
        'email',
        'password',
        'contact_info',
    ];

    // Define the method required by the Authenticatable interface

    public function getAuthIdentifierName()
    {
        return 'id'; // Assuming 'id' is the primary key of your landlords table
    }

    public function getAuthIdentifier()
    {
        return $this->getKey(); // Return the value of the primary key
    }

    public function getAuthPassword()
    {
        return $this->password; // Assuming 'password' is the hashed password field in your landlords table
    }
}