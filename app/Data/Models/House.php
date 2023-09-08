<?php

namespace App\Data\Models;

use App\Data\Traits\SlugifyTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Data\Models\House
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $location
 * @property int $category_id
 * @mixin \Eloquent
 */
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

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function units(): HasMany
    {
        return $this->hasMany(Unit::class);
    }

    public function staffs(): HasMany
    {
        return $this->hasMany(Staff::class);
    }
}
