<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function getDateCreatedAtAttribute()
    {
        return $this->created_at->format('d/m/Y');
    }
}