<?php

namespace App\Data\Repositories\Unit;

use App\Data\Models\Tenant;
use App\Data\Models\Unit;
use App\Data\Transformers\UnitTransformer;

/**
 * Class UnitRepository
 * @package App\Data\Repositories\Unit
 */
class UnitRepository implements InterfaceUnitRepository
{
    /**
     * Retrieve all resource in storage.
     *
     * @param  Boolean  $paginate
     */
    public function getAll($paginate = true)
    {
        $unitQ = $this->unitQuery();

        $units = $paginate
            ? $unitQ->paginate(10)->appends(request()->all())
            : $unitQ->isAssigned(false)->get();

        UnitTransformer::transformCollection($units);
        return $units;
    }

    /**
     * Retrieve all units based on house in storage.
     *
     * @param  Integer  $houseId
     * @param  Boolean  $paginate
     */
    public function getUnitsByHouse($houseId, $paginate = true)
    {
        $unitQ = $this->unitQuery($houseId);

        $units = $paginate
            ? $unitQ->paginate(5)->appends(request()->all())
            : $unitQ->get();

        UnitTransformer::transformCollection($units);
        return $units;
    }

    private function unitQuery($houseId = null)
    {
        $query = Unit::with('tenant', 'house')
            ->when(request()->get('search'), function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('block', 'like', "%{$search}%");
            })
            ->orderByDesc('status');

        return empty($houseId) ? $query : $query->where('house_id', $houseId);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Array  $attributes
     */
    public function store($attributes)
    {
        Unit::create($attributes);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Array  $attributes
     * @param  \App\Data\Models\Unit  $unit
     */
    public function update($attributes, Unit $unit)
    {
        $unit->update($attributes);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Data\Models\Unit  $unit
     */
    public function delete(Unit $unit)
    {
        $unit->delete();
    }
}
