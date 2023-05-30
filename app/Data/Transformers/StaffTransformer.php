<?php

namespace App\Data\Transformers;

use App\Data\Models\Staff;

/**
 * Class StaffTransformer
 * @package App\Data\Transformers
 */
class StaffTransformer
{
    /**
     * @param mixed $staffs
     * @return mixed
     */
    public static function transformCollection($staffs)
    {
        return $staffs->transform(function ($staff) {
            return self::transform($staff);
        });
    }

    /**
     * @param Staff $staff
     * @return array
     */
    public static function transform($staff)
    {
        return [
            'id' => $staff->id,
            'name' => $staff->user->name,
            'email' => $staff->user->email,
            'phone' => $staff->user->phone,
            'role' => $staff->role,
        ];
    }
}
