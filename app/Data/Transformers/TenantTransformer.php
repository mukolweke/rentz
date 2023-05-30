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
            'user_id' => $tenant->user_id,
            'name' => $tenant->user->name,
            'email' => $tenant->user->email,
            'phone' => $tenant->user->phone,
            'occupation' => $tenant->user->occupation,
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
}
