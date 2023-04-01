<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Data\Models\House;
use App\Data\Repositories\Category\CategoryRepository;
use App\Data\Repositories\House\HouseRepository;
use App\Data\Transformers\HouseTransformer;
use App\Data\Transformers\UnitTransformer;
use App\Http\Requests\HousePostRequest;

class HouseController extends Controller
{
    /**
     * HouseController constructor.
     * @param HouseRepository $houseRepo
     * @param CategoryRepository $categoryRepo
     */
    public function __construct(
        protected HouseRepository $houseRepo,
        protected CategoryRepository $categoryRepo
    ) {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Houses/Index', [
            'categories' => $this->categoryRepo->getAll(true),
            'categoryOptions' => $this->categoryRepo->getAll(),
            'houses' => $this->houseRepo->getAll(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\HousePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HousePostRequest $request)
    {
        // valid request
        $attributes = $request->safe()->only(['name', 'location', 'category_id']);

        // create a house
        $this->houseRepo->store($attributes);

        // redirect
        return redirect('/houses');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Data\Models\House  $house
     * @return \Illuminate\Http\Response
     */
    public function show(House $house)
    {
        $units = $house->units()->paginate(5);
        UnitTransformer::transformCollection($units);

        return Inertia::render('Houses/Show', [
            'house' => HouseTransformer::transform($house),
            'units' => $units,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Data\Models\House  $house
     * @return \Illuminate\Http\Response
     */
    public function edit(House $house)
    {
        return Inertia::render('Houses/Edit', [
            'house' => HouseTransformer::transformForEdit($house),
            'categoryOptions' => $this->categoryRepo->getAll(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\HousePostRequest  $request
     * @param  \App\Data\Models\House  $house
     * @return \Illuminate\Http\Response
     */
    public function update(HousePostRequest $request, House $house)
    {
        // valid request
        $attributes = $request->safe()->only(['name', 'location', 'category_id']);

        // create a house
        $this->houseRepo->update($attributes, $house);

        // redirect
        return redirect()->route('houses.show', $house->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Data\Models\House  $house
     * @return \Illuminate\Http\Response
     */
    public function destroy(House $house)
    {
        $this->houseRepo->delete($house);

        return redirect()->route('houses.index');
    }
}
