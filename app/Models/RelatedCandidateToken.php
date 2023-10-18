<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelatedCandidateToken extends Model
{
    use HasFactory;

    public function candidate(){
        return $this->belongsTo(Candidate::class, 'candidate_id');
    }

    public function sendBy(){
        return $this->belongsTo(User::class, 'mail_send_by_id');
    }

    public function position(){
        return $this->belongsTo(Position::class, 'position_id');
    }
}
