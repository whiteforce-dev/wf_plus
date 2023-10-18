<?php

namespace App\Models;
use App\Models\Stage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pipeline extends Model
{
    use HasFactory;
    protected $fillable = ['candidate_id'];


    public function candidate()
    {
        return $this->belongsTo(Candidate::class, 'candidate_id');
    }
    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id');
    }

    public function position_owner()
    {
        return $this->belongsTo(User::class, 'owner');
    }

    public function pco()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // public function company(){
    //     return $this->belongsTo(Client::class, 'id');
    // }

}