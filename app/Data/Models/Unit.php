<?php

namespace App\Data\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'description', 'block', 'house_id'
    ];

    protected $cast = [
        'name' => 'string',
        'description' => 'string',
        'block' => 'string',
        'house_id' => 'integer',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $appends = array('has_tenant');

    public function house()
    {
        return $this->belongsTo(House::class);
    }

    public function tenant()
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
