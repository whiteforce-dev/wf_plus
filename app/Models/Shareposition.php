<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shareposition extends Model
{
    use HasFactory;
    protected $table='sharepositions';

    public function position()
    {
        return $this->belongsTo(Position::class, 'positionId');
    }
}
