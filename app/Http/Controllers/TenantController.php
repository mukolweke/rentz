<?php

namespace App\Http\Controllers;

use App\Data\Models\House;
use App\Data\Models\Tenant;
use App\Data\Models\Unit;
use App\Data\Models\User;
use App\Data\Repositories\Unit\UnitRepository;
use App\Data\Transformers\HouseTransformer;
use App\Data\Transformers\NextOfKinTransformer;
use App\Data\Transformers\StaffTransformer;
use App\Data\Transformers\UnitTransformer;
use App\Data\Transformers\UserTransformer;
use App\Http\Requests\TenantUpdatePostRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
        $user = Auth::user();

        return Inertia::render('Tenant/Dashboard', [
            'user' => UserTransformer::transform($user),
            'unit' => UnitTransformer::assignedUnitTransformer($user->tenant->unit),
            'nextOfKins' => NextOfKinTransformer::transformCollection($user->nextOfKins)
        ]);
    }

    /**
     * View the tenant edit dashboard page
     */
    public function edit()
    {
        $user = Auth::user();

        return Inertia::render('Tenant/Edit', [
            'user' => UserTransformer::transform($user),
            'unit' => UnitTransformer::assignedUnitTransformer($user->tenant->unit),
            'nextOfKins' => NextOfKinTransformer::transformCollection($user->nextOfKins)
        ]);
    }

    /**
     * Update the tenant details
     *
     * @param  \App\Data\Models\User  $user
     * @param  TenantUpdatePostRequest  $request
     */
    public function update(TenantUpdatePostRequest $request, User $user)
    {
        switch ($request->type) {
            case 'about':
                $user->update($request->only(['name', 'occupation']));
                break;
            case 'contact':
                $user->update($request->only(['email', 'phone']));
                break;
            case 'password':
                $user->update(['password' => Hash::make($request->get('password'))]);
                break;
            default;
                break;
        }

        // redirect
        return redirect()->back();
    }

    /**
     * View the House/Unit/Neighbours Details
     * @param  \App\Data\Models\House  $house
     */
    public function viewHouseDetails(House $house)
    {
        $user = Auth::user();

        $staffs = $house->staffs()->paginate(5);
        StaffTransformer::transformCollection($staffs);

        $neighbours = User::where('id', '!=', Auth::id())
            ->whereHas('tenant', function ($query) {
                return $query->IsActive();
            })
            ->paginate(5);
        UserTransformer::transformCollection($neighbours);

        return Inertia::render('Tenant/House/Index', [
            'user' => UserTransformer::transform($user),
            'unit' => UnitTransformer::assignedUnitTransformer($user->tenant->unit),
            'house' => HouseTransformer::transform($house),
            'staffs' => $staffs,
            'neighbours' => $neighbours
        ]);
    }
}
