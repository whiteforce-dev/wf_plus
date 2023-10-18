<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateResponse extends Model
{
    protected $table = 'candidate_response_master';
    public function candidate(){
        return $this->belongsTo(Candidate::class, 'candidate_id');
    }
}