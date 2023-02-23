<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Cfdonation extends Model
{
	public function cfcampaigns() {
        return $this->belongsTo(Cfcampaign::class);
    }

    // protected $fillable = [
    //     'amount', 'display_name', 'note', 'hide_name', 'campaign', 'apeal', 'firstname', 'lastname', 'email', 'address', 'city', 'postcode','giftaid','reference'
    // ];
}

