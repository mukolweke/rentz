<?php

namespace App\Data\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Data\Models\Unit
 *
 * @property int $id
 * @property string $name
 * @property string|null $block
 * @property string $description
 * @property int $house_id
 * @property int $status
 *
 * @mixin \Eloquent
 */
class Unit extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'description', 'block', 'house_id', 'status'
    ];

    protected $cast = [
        'name' => 'string',
        'description' => 'string',
        'block' => 'string',
        'house_id' => 'integer',
        'status' => 'boolean',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $appends = array('has_tenant');

    public function house(): BelongsTo
    {
        return $this->belongsTo(House::class);
    }

    public function tenant(): HasOne
    {
        return $this->hasOne(Tenant::class);
    }

    public function scopeIsAssigned($query, $assigned = true)
    {
        return $assigned
            ? $query->whereHas('tenant', function ($query) {
                return $query->where('is_active', true);
            })
            : $query->whereDoesntHave('tenant')
            ->orWhereHas('tenant', function ($query) {
                return $query->where('is_active', false);
            });
    }

    public function getHasTenantAttribute()
    {
        return $this->tenant()->exists();
    }
}
