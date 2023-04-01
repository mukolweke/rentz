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

    public function house()
    {
        return $this->belongsTo(House::class);
    }
}
