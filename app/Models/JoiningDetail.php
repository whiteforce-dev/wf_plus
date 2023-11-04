<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JoiningDetail extends Model
{
    protected $table = 'joiningdetails';
    protected $guarded = ['id', '_token'];
    use HasFactory;
}
