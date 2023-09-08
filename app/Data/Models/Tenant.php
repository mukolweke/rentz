<?php

namespace App\Data\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Data\Models\Tenant
 *
 * @property int $id
 * @property int $user_id
 * @property int $unit_id
 * @property int $is_active
 *
 * @mixin \Eloquent
 */
class Tenant extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id', 'unit_id', 'is_active'
    ];

    protected $cast = [
        'is_active' => 'boolean',
        'user_id' => 'integer',
        'unit_id' => 'integer',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    public function getContactInfoAttribute(): string
    {
        return $this->user->email . '<br/><br/>' . $this->user->phone;
    }

    public function scopeIsActive($query, $active = true): mixed
    {
        return $query->where('is_active', $active);
    }
}
