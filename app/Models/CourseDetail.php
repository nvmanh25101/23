<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseDetail extends Model
{
    use HasFactory;
    protected $fillable = ['lesson_start', 'lesson_total', 'date', 'course_id'];
}
