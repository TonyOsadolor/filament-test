<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Traits\ModelMasksRecordId;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes, ModelMasksRecordId;

    /**
     * This is for Tenancy Mode
     * use ModelMasksRecordId;
     */

    public const SQID_ALPHABET = "348abe21dc7069f5";
	public const SQID_MIN_LENGTH = 32;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'ref_num',
        'surname',
        'first_name',
        'middle_name',
        'phone',
        'email',
        'password',
        'user_type',
        'is_admin',
        'admin_level',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Automatically assigning
     * 1. UUID
     * 2. Ref Number
     * 3. Password
     * to Every created Record on this model
     */
    protected static function booted()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = Str::uuid();
            $model->ref_num = "SRP".rand(100000000, 999999999);
            $model->password = Hash::make('12345678');
        });
    }
}
