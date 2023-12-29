<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'register_id', 'whatapp_no', 'gender', 'present_address', 'area_locality',
         'city', 'pin_code','class', 'school', 'sujects', 'board', 'guardian_name', 'guardian_contact',
         'profile_pic', 'tutor_gender', 'no_of_classes', 'convenient_days', 'convenient_time', 'student_id','reference_id'

    ];
}
