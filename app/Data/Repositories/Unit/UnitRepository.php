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
        $unitQ = Unit::with('house')->latest('id');

        $units = $paginate ? $unitQ->paginate(5) : $unitQ->isAssigned(false)->get();

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
        $unitQ = Unit::with('house')->latest('id')->where('house_id', $houseId);

        $units = $paginate ? $unitQ->paginate(5) : $unitQ->get();

        UnitTransformer::transformCollection($units);
        return $units;
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
    public function update($attributes, $unit)
    {
        $unit->update($attributes);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Data\Models\Unit  $unit
     */
    public function delete($unit)
    {
        $unit->delete();
    }
}
