<?php

namespace App\Data\Models;

use App\Data\Traits\SlugifyTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class House extends Model
{
    use HasFactory, SoftDeletes, SlugifyTrait;

    protected $fillable = [
        'name', 'slug', 'location', 'category_id'
    ];

    protected $cast = [
        'name' => 'string',
        'slug' => 'string',
        'location' => 'string',
        'category_id' => 'integer',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public static function boot()
    {
        parent::boot();

        self::handleObserver();
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function units()
    {
        return $this->hasMany(Unit::class);
    }

    public function staffs()
    {
        return $this->hasMany(Staff::class);
    }
}
