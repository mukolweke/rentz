<?php

namespace App\Data\Transformers;

use App\Data\Models\House;
use Carbon\Carbon;

/**
 * Class HouseTransformer
 * @package App\Data\Transformers
 */
class HouseTransformer
{
    /**
     * @param mixed $houses
     * @return mixed
     */
    public static function transformCollection($houses)
    {
        return $houses->transform(function ($house) {
            return self::transform($house);
        });
    }

    /**
     * @param House $house
     * @return array
     */
    public static function transform($house)
    {
        return [
            'id' => $house->id,
            'name' => $house->name,
            'slug' => $house->slug,
            'location' => $house->location,
            'category' => $house->category->name,
            'created on' => Carbon::parse($house->created_at)->format('d-m-Y'),
            'updated on' => Carbon::parse($house->updated_at)->format('d-m-Y'),
        ];
    }

    /**
     * @param House $house
     * @return array
     */
    public static function transformForEdit($house)
    {
        return [
            'id' => $house->id,
            'name' => $house->name,
            'location' => $house->location,
            'category_id' => $house->category_id,
        ];
    }
}
