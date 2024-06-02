<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Course extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'course_ref',
        'code',
        'title',
        'desc',
        'slug',
        'is_available',
    ];

    /**
     * Automatically assigning
     * 1. Ref Number
     * 2. UUID
     * to Every created Record on this model
     */
    protected static function booted()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->ref_num = "SCR".rand(100000000, 999999999);
            $model->uuid = Str::uuid();
        });
    }
}
