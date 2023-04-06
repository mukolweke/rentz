<?php

namespace App\Data\Transformers;

use App\Data\Models\Tenant;
use Carbon\Carbon;

/**
 * Class TenantTransformer
 * @package App\Data\Transformers
 */
class TenantTransformer
{
    /**
     * @param mixed $tenants
     * @return mixed
     */
    public static function transformCollection($tenants)
    {
        return $tenants->transform(function ($tenant) {
            return self::transform($tenant);
        });
    }

    /**
     * @param Tenant $tenant
     * @return array
     */
    public static function transform($tenant)
    {
        return [
            'id' => $tenant->id,
            'name' => $tenant->user->fullName,
            'email' => $tenant->user->email,
            'phone' => $tenant->phone,
            'contact_info' => $tenant->contact_info,
            'unit' => $tenant->unit->name,
            'unit_id' => $tenant->unit_id,
            'created_on' => Carbon::parse($tenant->created_at)->format('d-m-Y'),
            'updated_on' => Carbon::parse($tenant->updated_at)->format('d-m-Y'),
            'removed_on' => !($tenant->is_active)
                ? Carbon::parse($tenant->updated_at)->format('d-m-Y')
                : null,
        ];
    }

    /**
     * @param Tenant $tenant
     * @return array
     */
    public static function transformForEdit($tenant)
    {
        return [
            'id' => $tenant->id,
            'first_name' => $tenant->user->first_name,
            'last_name' => $tenant->user->last_name,
            'email' => $tenant->user->email,
            'phone' => $tenant->phone,
            'unit_id' => $tenant->unit_id,
        ];
    }
}
