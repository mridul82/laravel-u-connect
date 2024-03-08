<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentExam extends Model
{
    use HasFactory;

    protected $fillable = [

        'student_id', 'exam_id', 'test_code', 'test_price', 'test_date', 'test_time', 'is_active' ,'payment'
    ];
}
