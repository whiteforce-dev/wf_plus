<?php

namespace App\Models;




use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;
    protected $guarded = ['id', '_token'];

    public $stagesArr = [
        'sourcing',
        'telephonic',
        'f2f',
        'not_attend',
        'rejected',
        'hot',
        'hold',
        'selected',
        'backout',
        'offered',
        'joined',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['PipelineCount'];

 
    public function findClientGet()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function findUserData()
    {
        return $this->belongsTo('App\models\User', 'created_by');
    }

    public function positionShareRelation()
    {
        return $this->hasOne('App\Models\Shareposition', 'positionId');
    }

    public function jobPostingRelation()
    {
        return $this->hasOne('App\Models\JobPostingModel', 'job_id');
    }

    public function PositionWithAplyCand()
    {
        return $this->hasOne('App\Models\Applied_Candidate', 'job_id');
    }

    public function portalResponse()
    {
        return $this->hasMany('App\Models\Portalresponse','job_id','id')->orderBy('id', 'desc');
    }

    public function getJobPortalResponse($portal){
        return $this->portalResponse->where('portal', $portal)->first();
        
    }
    public function pipeline()
    {
        return $this->hasMany(Pipeline::class, 'position_id', 'id');
    }

    public function getPipelineCountAttribute()
    {
       return $this->hasMany(Pipeline::class, 'position_id', 'id')->count();
   
    }

    public function getFirstPipelineAttribute()
    {
       $data = $this->hasMany(Pipeline::class, 'position_id', 'id')->first();
        if($data){
            return modDate($data->created_at , 'F d, Y');
        }
        return '-';
    }

}