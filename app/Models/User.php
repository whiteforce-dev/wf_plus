<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     *
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'software_category',
        'role',
        'parent_id',
        'profile_image',
        'contact',
        'is_dummy'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function parent()
    {
        return $this->belongsTo(User::class, 'parent_id')->where('is_active', 1);    
    }

    public function getrealparentAttribute(){
        $data = $this->parent;
        if(!empty($data) && $data->is_dummy){
           return $data->realparent;
        }
        return $data;
    }


    public function ascendantIds()
    {
        $ids = [];

        if ($this->parent) {
            $ids = $this->parent->ascendantIds();
            $ids[] = $this->parent->id;
        }

        return $ids;
    }


    public function children()
    {
        return $this->hasMany(User::class, 'parent_id')->where(['is_active'=> 1, 'software_category' => Auth::user()->software_category]);
    }



    public function descendants()
    {
        return $this->children()->with('descendants');
    }

    public function descendantIds()
    {
        $ids = $this->children()->pluck('id')->toArray();
        foreach ($this->children as $child) {
            $ids = array_merge($ids, $child->descendantIds());
        }

        return $ids;
    }

    public function avtar(){
       $image = $this->profile_image;
       
       if(file_exists($image)){
            return url($image);
       }else{
        return 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png';
       }
    }

    public function thumb(){
       $image = $this->profile_image;
       
       if(file_exists($image)){
            $path = str_replace('user-image/', 'user-image/thumb/', $image);
            return url($path);
       }else{
        return 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png';
       }
    }
    
    // public function targets()
    // {
    //     return $this->hasMany(Target::class,'user_id')->latest();
    // }

    public function targets()
    {
        return $this->hasMany(MonthlyTarget::class,'user_id')->latest();
    }

    public function getNameAttribute($value)
    {
        return ucwords(strtolower($value));
    }


    // public function getTargetThisQuarter(){
    //     return $target = Target::selectRaw('YEAR(created_at) AS year, QUARTER(created_at) AS quarter,  SUM(month_target) AS month_total, SUM(complete) AS complete_total, (SUM(month_target) - SUM(complete)) AS quarterly_left')
    //         ->whereYear('created_at', Carbon::now()->year)
    //         ->groupBy('year', 'quarter')
    //         ->where('user_id', $this->id)
    //         ->first();
    // }

    public function getTargetThisQuarter(){

        $currentMonth = date('n'); // Get the current month (1 to 12)

        if ($currentMonth >= 1 && $currentMonth <= 3) {
            $currentQuarter = 1;
        } elseif ($currentMonth >= 4 && $currentMonth <= 6) {
            $currentQuarter = 2;
        } elseif ($currentMonth >= 7 && $currentMonth <= 9) {
            $currentQuarter = 3;
        } else {
            $currentQuarter = 4;
        }

    
        $target = MonthlyTarget::where(['quarter' => $currentQuarter, 'year' => date('Y'), 'user_id' => $this->id])->sum('target');

        $completed = Pipeline::where(['join_quarter' => $currentQuarter, 'join_quarter_year' => date('Y'), 'created_by' => $this->id])->sum('offerd_ctc');

        $left = $target - $completed;

        return [
            'target' => $target,
            'completed' => $completed,
            'left' => $left
        ];

    }

    public function checkTarget($id){
        $user=User::find($id);
        $currentMonth = Carbon::now()->month;
        $targetForCurrentMonth = $user->targets->filter(function ($target) use ($currentMonth) {
            return $target->created_at->month === $currentMonth;
        })->first();

       return $targetForCurrentMonth ?? 0;
    }
}
