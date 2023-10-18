<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sheet extends Model
{
    protected $table = "calling_sheets";

    protected $fillable = [
        'company_name',
        'candidate_name',
        'mobile',
        'position',
        'status',
        'reference',
        // add more attributes here as needed
    ];

    public  function GetUser()
    {
        return $this->belongsTo(User::class,'created_by');
    }

    public function pipeline()
    {
        return $this->hasMany(Pipeline::class, 'created_by');
    }


}