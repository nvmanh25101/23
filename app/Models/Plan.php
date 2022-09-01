<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = ['semester', 'subject_id', 'classroom_id'];
    public $timestamps = false;
    use HasFactory;
    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
