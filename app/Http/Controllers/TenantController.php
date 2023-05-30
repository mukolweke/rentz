<?php

namespace App\Http\Controllers;

use App\Data\Models\Tenant;
use App\Data\Models\Unit;
use App\Data\Repositories\Unit\UnitRepository;

class TenantController extends Controller
{
    /**
     * TenantController constructor.
     *
     * @param UnitRepository $unitRepo
     */
    public function __construct(
        protected UnitRepository $unitRepo
    ) {
    }

    /**
     * Remove the link of a tenant to a unit.
     *
     * @param  \App\Data\Models\Unit  $unit
     * @param  \App\Data\Models\Tenant  $tenant
     * @return \Illuminate\Http\Response
     */
    public function removeTenant(Unit $unit, Tenant $tenant)
    {
        // remove tenant from a unit
        $tenant->update(['is_active' => false]);

        // update unit status
        $unit->update(['status', false]);

        // redirect
        return redirect()->route('units.show', $unit->id);
    }
}
