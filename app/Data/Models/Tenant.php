<?php

namespace App\Data\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tenant extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id', 'unit_id', 'phone',
    ];

    protected $cast = [
        'phone' => 'string',
        'user_id' => 'integer',
        'unit_id' => 'integer',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function getContactInfoAttribute()
    {
        return $this->user->email . '<br/><br/>' . $this->phone;
    }
}
