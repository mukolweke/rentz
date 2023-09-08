<?php

namespace App\Data\Repositories\Unit;

use App\Data\Models\Unit;

/**
 * InterfaceUnitRepository
 * @package App\Data\Repositories\Unit
 */
interface InterfaceUnitRepository
{
    /**
     * Retrieve all resource in storage.
     *
     * @param  Boolean  $paginate
     */
    public function getAll($paginate = true);

    /**
     * Retrieve all units based on house in storage.
     *
     * @param  Integer  $houseId
     * @param  Boolean  $paginate
     */
    public function getUnitsByHouse($houseId, $paginate = true);

    /**
     * Store a newly created resource in storage.
     *
     * @param  Array  $attributes
     */
    public function store($attributes);

    /**
     * Update the specified resource in storage.
     *
     * @param  Array  $attributes
     * @param  \App\Data\Models\Unit  $unit
     */
    public function update($attributes, Unit $unit);

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Data\Models\Unit  $unit
     */
    public function delete(Unit $unit);
}
