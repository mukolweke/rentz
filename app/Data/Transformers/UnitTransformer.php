<?php

namespace App\Data\Transformers;

use App\Data\Models\Unit;
use Carbon\Carbon;

/**
 * Class UnitTransformer
 * @package App\Data\Transformers
 */
class UnitTransformer
{
    /**
     * @param mixed $units
     * @return mixed
     */
    public static function transformCollection($units)
    {
        return $units->transform(function ($unit) {
            return self::transform($unit);
        });
    }

    /**
     * @param Unit $unit
     * @return array
     */
    public static function transform($unit)
    {
        $available = !$unit->tenant()->isActive()->exists()
            ? '<div class="bg-purple-500 text-white font-medium p-1 px-4 rounded text-center">Not Assigned</div>'
            : '<div class="bg-primaryGreen text-white p-1 px-4 rounded text-center">Assigned</div>';

        return [
            'id' => $unit->id,
            'name' => $unit->name,
            'block' => $unit->block ?? '-',
            'description' => $unit->description,
            'house' => $unit->house->name,
            'house_id' => $unit->house_id,
            'available' => $available,
            'created_on' => Carbon::parse($unit->created_at)->format('d-m-Y'),
            'updated_on' => Carbon::parse($unit->updated_at)->format('d-m-Y'),
        ];
    }

    /**
     * @param Unit $unit
     * @return array
     */
    public static function transformForEdit($unit)
    {
        return [
            'id' => $unit->id,
            'name' => $unit->name,
            'block' => $unit->block ?? '',
            'description' => $unit->description,
            'house_id' => $unit->house_id,
        ];
    }
}
