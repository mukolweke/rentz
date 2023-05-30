<?php

namespace App\Http\Controllers;

use App\Data\Models\House;
use App\Data\Repositories\House\HouseRepository;
use App\Data\Repositories\Unit\UnitRepository;
use App\Data\Transformers\StaffTransformer;
use Illuminate\Http\Request;

class GetApiData extends Controller
{
    /**
     * UserController constructor.
     *
     * @param UnitRepository $unitRepo
     */
    public function __construct(
        protected UnitRepository $unitRepo,
        protected HouseRepository $houseRepo,
    ) {
    }

    public function unitOptions()
    {
        return $this->unitRepo->getAll(false);
    }

    public function houseOptions()
    {
        return $this->houseRepo->getAll(false);
    }

    public function houseStaff(House $house)
    {
        $staffs = $house->staffs()->paginate(5);

        StaffTransformer::transformCollection($staffs);

        return $staffs;
    }
}
