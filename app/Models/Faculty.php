<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function majors()
    {
        return $this->hasMany(Major::class);
    }

    public function getCreatedAtAttribute($value)
    {
        return (date("d/m/Y", strtotime($value)));
    }
}
