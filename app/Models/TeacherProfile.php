<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'register_id', 'whatapp_no', 'gender', 'present_address', 'area_locality',
         'city', 'pin_code', 'highest_qualification', 'specialisation', 'preferred_subject', 'preferred_location','preferred_time',

         'profile_pic', 'education_document1', 'education_document2', 'education_document3', 'education_document4', 'teacher_id'
    ];

}
