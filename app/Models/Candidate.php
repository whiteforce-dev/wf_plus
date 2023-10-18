<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'mobile',
        'email',
        'experience',
        'apply_for',
        'current_company',
        'current_title',
        'current_location',
        'preferred_location',
        'country',
        'state',
        'city',
        'address',
        'pin_code',
        'highest_qualification',
        'highest_qualification_type',
        'highest_qualification_year',
        'total_experience',
        'date_of_birth',
        'is_relocate',
        'salary_type',
        'current_salary_in_lakh',
        'current_salary_in_thousand',
        'expected_salary',
        'marital_status',
        'industry',
        'languages',
        'notice_period',
        'gender',
        'communication',
        'skills',
        'resume_file',
        'last_company',
        'last_ctc',
        'passbook',
        'pan_card',
        'aadhar_card',
        'image',
        'is_active',
        'created_by',
        'publish_to',
        'is_publisher',
        'job_title',
        'is_archive',
        'added_by_type',
        'candidate_type',
    ];


    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function countryName(){

        return $this->belongsTo(Country::class, 'country');
    }

    public function stateName(){

        return $this->belongsTo(State::class, 'state');
    }
    public function cityName(){

        return $this->belongsTo(Cities::class, 'city');
    }
}