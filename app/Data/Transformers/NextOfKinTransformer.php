<?php

namespace App\Data\Transformers;

use App\Data\Models\NextOfKin;

/**
 * Class NextOfKinTransformer
 * @package App\Data\Transformers
 */
class NextOfKinTransformer
{
    /**
     * @param mixed $nextOfKins
     * @return mixed
     */
    public static function transformCollection($nextOfKins)
    {
        return $nextOfKins->transform(function ($nextOfKin) {
            return self::transform($nextOfKin);
        });
    }

    /**
     * @param NextOfKin $nextOfKin
     * @return array
     */
    public static function transform($nextOfKin)
    {
        return [
            'name' => $nextOfKin->name,
            'email' => $nextOfKin->email,
            'phone' => $nextOfKin->phone,
            'relation' => $nextOfKin->relation
        ];
    }

    /**
     * @param NextOfKin $nextOfKin
     * @return array
     */
    public static function transformForEdit($nextOfKin)
    {
        return [
            'name' => $nextOfKin->name
        ];
    }
}
