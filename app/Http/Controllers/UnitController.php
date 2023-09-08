<?php

namespace App\Http\Controllers;

use App\Data\Models\Tenant;
use Inertia\Inertia;
use App\Data\Models\Unit;
use App\Data\Repositories\House\HouseRepository;
use App\Data\Repositories\Unit\UnitRepository;
use App\Data\Transformers\TenantTransformer;
use App\Data\Transformers\UnitTransformer;
use App\Http\Requests\UnitPostRequest;

class UnitController extends Controller
{
    /**
     * HouseController constructor.
     * @param HouseRepository $houseRepo
     * @param UnitRepository $unitRepo
     */
    public function __construct(
        protected HouseRepository $houseRepo,
        protected UnitRepository $unitRepo
    ) {
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        // Set Filters
        $houseId = request()->has('house') ? request()->get('house') : null;
        $units = is_null($houseId) ? $this->unitRepo->getAll() : $this->unitRepo->getUnitsByHouse($houseId);

        return Inertia::render('Units/Index', [
            'units' => $units,
            'house' => $houseId ? $this->houseRepo->getById($houseId) : null,
            'filters' => request()->only(['search'])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return Inertia::render('Units/Create', [
            'houseId' => request()->has('house') ? request()->get('house') : null,
            'housesOptions' => $this->houseRepo->getAll(false),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\UnitPostRequest  $request
     */
    public function store(UnitPostRequest $request)
    {
        // valid request
        $attributes = $request->safe()->only(['name', 'block', 'description', 'house_id']);

        // save the details
        $this->unitRepo->store($attributes);

        // redirect
        return redirect()->route('units.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Data\Models\Unit  $unit
     */
    public function show(Unit $unit)
    {
        $activeTenant = $unit->tenant()->isActive()->first();

        $prevTenants = $unit->tenant()->isActive(false)->paginate(5);
        TenantTransformer::transformCollection($prevTenants);

        return Inertia::render('Units/Show', [
            'unit' => UnitTransformer::transform($unit),
            'tenant' => $activeTenant
                ? TenantTransformer::transform($activeTenant)
                : null,
            'prevTenants' => $prevTenants,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Data\Models\Unit  $unit
     */
    public function edit(Unit $unit)
    {
        return Inertia::render('Units/Edit', [
            'unit' => UnitTransformer::transformForEdit($unit),
            'housesOptions' => $this->houseRepo->getAll(false),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UnitPostRequest  $request
     * @param  \App\Data\Models\Unit  $unit
     */
    public function update(UnitPostRequest $request, Unit $unit)
    {
        // valid request
        $attributes = $request->safe()->only(['name', 'block', 'description', 'house_id']);

        // save the details
        $this->unitRepo->update($attributes, $unit);

        // redirect
        return redirect()->route('units.show', $unit->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Data\Models\Unit  $unit
     */
    public function destroy(Unit $unit)
    {
        if ($unit->tenant) {
            $this->unitRepo->delete($unit);
        }

        // todo add an alert back if unit has a tenant

        // redirect
        return redirect()->route('units.index');
    }
}
