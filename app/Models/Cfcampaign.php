<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Cfcampaign extends Model
{
    protected $fillable = [
        'title', 'slug', 'goal', 'apeal', 'description', 'image', 'author', 'is_team', 'is_member', 'member_id', 'team_id'
    ];

    public function cfmembers()
    {
        return $this->belongsToMany(Cfmember::class);
    }

    public function cfdonations() 
    {
        return $this->hasMany(Cfdonation::class);
    }
}
