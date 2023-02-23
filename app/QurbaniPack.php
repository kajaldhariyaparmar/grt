<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class QurbaniPack extends Model
{
    protected $fillable = ['title','slug','small_amount','large_amount','share_amount','country_id'];
}
