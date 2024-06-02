<?php

namespace App\Models;

use App\Traits\ModelMasksRecordId;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Profile extends Model
{
    use HasFactory, SoftDeletes, ModelMasksRecordId;

    public const SQID_ALPHABET = "348abe21dc7069f5";
	public const SQID_MIN_LENGTH = 32;

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

    /**
     * Get the owning user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
