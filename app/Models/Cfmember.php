<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cfmember extends Model
{
    protected $fillable = [
        'user_id', 'type', 'firstname', 'lastname', 'email'
    ];

    public function cfcampaigns() {
        return $this->belongsToMany(Cfcampaign::class);
    }

   
}
