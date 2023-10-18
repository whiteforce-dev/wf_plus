<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientAllotment extends Model
{
    use HasFactory;
    protected $table = 'client_allotment';

    public function allotedTo()
    {
        return $this->belongsTo(User::class, 'alloted_to');
    }
}
