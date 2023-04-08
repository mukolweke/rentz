<?php

namespace App\Data\Repositories\House;

/**
 * Interface HouseRepository
 * @package App\Data\Repositories\House
 */
interface InterfaceHouseRepository
{
    /**
     * Retrieve all resource in storage.
     *
     * @param  Boolean  $paginate
     */
    public function getAll($paginate = true);

    /**
     * Retrieve the resource in storage by id.
     *
     * @param  Number  $id
     */
    public function getById($id);

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
     * @param  \App\Data\Models\House  $house
     */
    public function update($attributes, $house);

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Data\Models\House  $house
     */
    public function delete($house);
}
