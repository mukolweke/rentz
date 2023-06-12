<?php

namespace App\Http\Controllers;

use App\Data\Models\Tenant;
use App\Data\Models\Unit;
use App\Data\Repositories\Unit\UnitRepository;
use App\Data\Transformers\UserTransformer;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

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

        // Mark unit as unassigned
        $unit->update(['status', false]);

        // redirect
        return redirect()->route('units.show', $unit->id);
    }

    /**
     * View the tenant dashboard
     */
    public function dashboard()
    {
        return Inertia::render('Tenant/Dashboard', [
            'user' => UserTransformer::transform(Auth::user())
        ]);
    }
}
