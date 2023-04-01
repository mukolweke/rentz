<?php

namespace App\Data\Models;

use App\Data\Traits\SlugifyTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes, SlugifyTrait;

    protected $fillable = [
        'name', 'slug',
    ];

    protected $cast = [
        'name' => 'string',
        'slug' => 'string',
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
}
