<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Campaign extends Model
{
    public function projects(){
        return $this->belongsToMany(Project::class);
    }

    public function countries(){
        return $this->belongsToMany(Country::class);
    }

    public function posts(){
        return $this->belongsToMany(Post::class);
    }
}
