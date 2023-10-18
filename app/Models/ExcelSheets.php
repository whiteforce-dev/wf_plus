<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExcelSheets extends Model
{
    protected $table = 'calling_sheet_excel';

    public  function GetUser()
    {
        return $this->belongsTo(User::class,'created_by');
    }
}
