<?php

namespace App\Data\Transformers;

use App\Data\Models\User;
use Carbon\Carbon;

/**
 * Class UserTransformer
 * @package App\Data\Transformers
 */
class UserTransformer
{
    /**
     * @param mixed $users
     * @return mixed
     */
    public static function transformCollection($users)
    {
        return $users->transform(function ($user) {
            return self::transform($user);
        });
    }

    /**
     * @param User $user
     * @return array
     */
    public static function transform($user)
    {
        $role = match ($user->role) {
            'Admin' => '<div class="text-red-500 font-bold p-1 px-4 rounded text-center">Admin</div>',
            'Staff' => '<div class="text-green-500 font-bold p-1 px-4 rounded text-center">Staff</div>',
            'Tenant' => '<div class="text-yellow-500 font-bold p-1 px-4 rounded text-center">Tenant</div>',
            default => '',
        };

        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone ?? '-',
            'role_display' => $role,
            'role' => $user->role,
            'unit' => $user->tenant ? $user->tenant->unit->name : '',
            'unit_id' => $user->tenant ? $user->tenant->unit_id : null,
            'created_on' => Carbon::parse($user->created_at)->format('d-m-Y'),
            'updated_on' => Carbon::parse($user->updated_at)->format('d-m-Y'),
        ];
    }

    /**
     * @param User $user
     * @return array
     */
    public static function transformForEdit($user)
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'role' => $user->role,
            'email' => $user->email,
            'phone' => $user->phone,
            'unit_id' => $user->tenant ? $user->tenant->unit_id : null,
        ];
    }
}
