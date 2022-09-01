<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class AcademicYear extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['name'];

    protected static function boot()
    {
        parent::boot();
        static::saved(function ($model) {
            $model->name = "Khóa " . $model->id;
            $model->saveQuietly();
        });
    }
}
