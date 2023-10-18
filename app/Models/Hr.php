<?php

namespace App\Models;

use App\Models\Investment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Hr extends Model
{
    

    use HasFactory;
    function invest()
    {
        return $this->hasMany('App\Models\Investment', 'hr_Id');
    }

    public function hr_master()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
    public function clientName()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function thumb()
    {
        if ($this->clientName->id ?? 0) {
            return Client::findOrFail($this->clientName->id)->thumb();
        } else {
            return 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png';
        }
    }
}
