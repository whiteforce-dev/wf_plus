<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    public function countryName(){

        return $this->belongsTo(Country::class, 'country');
    }

    public function stateName(){

        return $this->belongsTo(State::class, 'state');
    }
    public function cityName(){

        return $this->belongsTo(Cities::class, 'location');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function hrs()
    {
        return $this->hasMany(Hr::class, 'client_id', 'id');
    }

    public function client_master()
    {
        return $this->hasMany('App\Models\Hr', 'hr_Id');
    }

    public function position(){
        return $this->hasMany(Position::class, 'client_id','id');
    }

    public function getPosition(){
        return $this->belongsTo(Position::class,'client_id');
    }


    public function lastPosition(){
        $data = Position::where('client_id', $this->id)->latest()->first();
        if($data){
            return modDate($data->created_at, 'F d, Y');
        }else{
            return '-';
        }
        
    }



    public function avtar(){
        $image = $this->image;
        
        if(file_exists($image)){
             return url($image);
        }else{
         return 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png';
        }
     }
 
     public function thumb(){
        $image = $this->image;
        
        if(file_exists($image)){
             $path = str_replace('client_images/', 'client_images/thumb/', $image);
             return url($path);
        }else{
         return 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png';
        }
     }


}
