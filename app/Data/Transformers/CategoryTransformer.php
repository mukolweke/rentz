<?php

namespace App\Data\Transformers;

use App\Data\Models\Category;
use Carbon\Carbon;

/**
 * Class CategoryTransformer
 * @package App\Data\Transformers
 */
class CategoryTransformer
{
    /**
     * @param mixed $categories
     * @return mixed
     */
    public static function transformCollection($categories)
    {
        return $categories->transform(function ($category) {
            return self::transform($category);
        });
    }

    /**
     * @param Category|null $category
     * @return array
     */
    public static function transform($category)
    {
        return [
            'id'    => $category->id,
            'name'  => $category->name,
            'slug'  => $category->slug,
            'created_on' => Carbon::parse($category->created_at)->format('d-m-Y'),
            'updated_on' => Carbon::parse($category->updated_at)->format('d-m-Y'),
        ];
    }
}
