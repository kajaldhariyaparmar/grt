<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Cfdonor extends Model
{
     protected $fillable = [
        'campaign', 'firstname', 'lastname', 'email', 'phone', 'address', 'city', 'postcode','reference'
    ];
}
