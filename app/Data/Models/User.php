<?php

namespace App\Data\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Data\Constants;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

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
            $model->password = Hash::make('password1234');
        });
    }

    public function tenant()
    {
        return $this->hasOne(Tenant::class);
    }

    public function isTenant()
    {
        return $this->role == 'tenant';
    }

    public function staff()
    {
        return $this->hasOne(Staff::class);
    }

    public function isStaff()
    {
        return $this->role == 'tenant';
    }

    public function nextOfKins()
    {
        return $this->hasMany(NextOfKin::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(Constants::USER_AVATAR_COLLECTION)
            ->singleFile();
    }
}
