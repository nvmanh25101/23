<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'major_id', 'training_id', 'academic_year_id'];

    public function major()
    {
        return $this->belongsTo(Major::class);
    }
    public function plans()
    {
        return $this->hasMany(Plan::class);
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }
    // public function subjects()
    // {
    //     return $this->belongsToMany(Subject::class);
    // }
}
