<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\facebookPage;

class FacebookToken extends Model
{
    public function facebookPages()
    {
        return $this->hasMany('App\Models\FacebookPage');
    }
}
