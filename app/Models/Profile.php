<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Profile extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'dept',
        'entry_year',
        'graduation_year',
        'approval_date',
        'passed_final_exam',
        'completed',
    ];

    /**
     * Automatically assigning
     * 2. UUID
     * to Every created Record on this model
     */
    protected static function booted()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }

    public static function initialProfile($user)
    {
        $profile = new Profile();
        $profile->user_id = $user->id;
        $profile->uuid = Str::uuid();
        $profile->save();
    }
}
