<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Data\Models\Unit;
use App\Data\Repositories\House\HouseRepository;
use App\Data\Repositories\Unit\UnitRepository;
use App\Data\Transformers\UnitTransformer;
use App\Http\Requests\UnitPostRequest;

class UnitController extends Controller
{
    /**
     * HouseController constructor.
     * @param HouseRepository $houseRepo
     * @param CategoryRepository $categoryRepo
     */
    public function __construct(
        protected HouseRepository $houseRepo,
        protected UnitRepository $unitRepo
    ) {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Units/Index', [
            'units' => $this->unitRepo->getAll(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Units/Create', [
            'housesOptions' => $this->houseRepo->getAll(false),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\UnitPostRequest  $request
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
     */
    public function show(Unit $unit)
    {
        return Inertia::render('Units/Show', [
            'unit' => UnitTransformer::transform($unit),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Data\Models\Unit  $unit
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unit $unit)
    {
        $this->unitRepo->delete($unit);

        // redirect
        return redirect()->route('units.index');
    }
}