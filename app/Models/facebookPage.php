<?php

namespace App\Models;

use App\Models\FacebookToken;
use App\Models\FacebookPage;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacebookPage extends Model
{
    public function facebookToken()
    {
        return $this->belongsTo('App\Models\FacebookToken');
    }
}
