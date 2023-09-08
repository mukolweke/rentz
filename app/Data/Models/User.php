<?php

namespace App\Data\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Data\Constants;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * App\Data\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $phone
 * @property string $role
 * @property string|null $occupation
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 *
 * @mixin \Eloquent
 */
class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'email', 'phone', 'role', 'password', 'occupation'
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function boot()
    {
        parent::boot();

        self::handleObserver();
    }

    public static function handleObserver()
    {
        static::creating(function ($model) {
            $model->password = Hash::make(Constants::DEFAULT_PASSWORD);
        });
    }

    public function tenant(): HasOne
    {
        return $this->hasOne(Tenant::class);
    }

    public function isTenant()
    {
        return $this->role == 'tenant';
    }

    public function staff(): HasOne
    {
        return $this->hasOne(Staff::class);
    }

    public function isStaff()
    {
        return $this->role == 'staff';
    }

    public function nextOfKins(): HasMany
    {
        return $this->hasMany(NextOfKin::class);
    }

    public function registerMediaCollections(): void
    {
        // USER AVATAR
        $this->addMediaCollection(Constants::USER_AVATAR_COLLECTION)
            ->singleFile();

        // TENANT DASH HEADER
        $this->addMediaCollection(Constants::USER_HEADER_COLLECTION)
            ->singleFile();
    }
}
