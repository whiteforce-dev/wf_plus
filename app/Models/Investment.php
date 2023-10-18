<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
    use HasFactory;
    // function getClientRelation()
    // {
    //     return $this->belongeTo('App\Models\Client', 'client_id');
    // }
    public function HrWithClient()
    {
        return $this->belongsTo('App\Models\Hr', 'hrId');
    }
   
}
