<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientList extends Model
{
    protected $table = 'clientlist';
    protected $primaryKey = 'client_id';
    use HasFactory;
}
