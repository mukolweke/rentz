<?php

namespace App\Data\Repositories\House;

use App\Data\Models\House;
use App\Data\Transformers\HouseTransformer;

/**
 * Class HouseRepository
 * @package App\Data\Repositories\House
 */
class HouseRepository implements InterfaceHouseRepository
{
    /**
     * Retrieve all resource in storage.
     *
     * @param  Boolean  $paginate
     */
    public function getAll()
    {
        $houses = House::latest('id')->paginate(5);

        HouseTransformer::transformCollection($houses);
        return $houses;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Array  $attributes
     */
    public function store($attributes)
    {
        House::create($attributes);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Array  $attributes
     * @param  \App\Data\Models\House  $house
     */
    public function update($attributes, $house)
    {
        $house->update($attributes);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Data\Models\House  $house
     */
    public function delete($house)
    {
        $house->delete();
    }
}
