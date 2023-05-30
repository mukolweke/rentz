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
        $available = !$unit->status
            ? '<div class="bg-primary text-white font-medium p-1 px-4 rounded text-center">Not Assigned</div>'
            : '<div class="bg-green-500 text-white p-1 px-4 rounded text-center">Assigned</div>';

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

    /**
     * @param Unit $unit
     * @return array
     */
    public static function assignedUnitTransformer($unit)
    {
        $tenant = $unit->tenant()->latest()->first();

        return [
            'id' => $unit->id,
            'tenant_id' => $tenant->id,
            'house' => $unit->house->name,
            'name' => $unit->name,
            'block' => $unit->block ?? '-',
            'parking' => 'Todo Parking',
            'tenant_joined_on' => Carbon::parse($tenant->created_at)->format('M d Y'),
            'tenant_removed_on' => !$tenant->is_active ? Carbon::parse($tenant->updated_at)->format('M d Y') : null,
        ];
    }
}
