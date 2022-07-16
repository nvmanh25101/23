<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'gender',
        'email',
        'password',
        'birthdate',
        'address',
        'phone',
        'faculty_id',
        'level',
        'status',
    ];

    public function courses(): HasOne
    {
        return $this->hasOne(Course::class);
    }

    public function faculty(): BelongsTo
    {
        return $this->belongsTo(Faculty::class);
    }

    public function getGenderNameAttribute(): string
    {
        return ($this->gender === 0) ? 'Nữ' : 'Nam';
    }

    public function getAgeAttribute(): int
    {
        return date_diff(date_create($this->birthdate), date_create('now'))->y;
    }

    public function getDateAttribute(): string
    {
        return date('Y-m-d', strtotime($this->birthdate));
    }
}
