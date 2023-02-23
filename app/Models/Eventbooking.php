<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Eventbooking extends Model
{
    protected $fillable = [
        'firstname', 'lastname', 'notickets', 'phone', 'email', 'locationdates'
    ];
}
