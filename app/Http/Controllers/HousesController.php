<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Data\Models\Category;
use App\Data\Models\House;
use Carbon\Carbon;

class HousesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest('id')->paginate(5)->through(fn ($category) => [
            'id' => $category->id,
            'name' => $category->name,
            'slug' => $category->slug,
            'created_on' => Carbon::parse($category->created_at)->format('d-m-Y'),
            'updated_on' => Carbon::parse($category->updated_at)->format('d-m-Y'),
        ]);

        $categoryOptions = Category::select(['id', 'name', 'slug'])->get()->toArray();

        $houses = House::latest()->paginate(5)->through(fn ($house) => [
            'id' => $house->id,
            'name' => $house->name,
            'slug' => $house->slug,
            'location' => $house->location,
            'category' => $house->category->name,
            'created_on' => Carbon::parse($house->created_at)->format('d-m-Y'),
            'updated_on' => Carbon::parse($house->updated_at)->format('d-m-Y'),
        ]);

        return Inertia::render('Houses/Index', [
            'categories' => $categories,
            'categoryOptions' => $categoryOptions,
            'houses' => $houses,
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validation
        $attributes = $request->validate([
            'name' => 'required|max:60',
            'location' => 'required',
            'category_id' => 'required',
        ]);

        // create a house
        House::create($attributes);

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
        return Inertia::render('Houses/Show', [
            'house' => [
                'id' => $house->id,
                'name' => $house->name,
                'slug' => $house->slug,
                'location' => $house->location,
                'category' => $house->category->name,
                'created on' => Carbon::parse($house->created_at)->format('d-m-Y'),
                'updated on' => Carbon::parse($house->updated_at)->format('d-m-Y'),
            ],
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
        $categoryOptions = Category::select(['id', 'name', 'slug'])->get()->toArray();

        return Inertia::render('Houses/Edit', [
            'house' => [
                'id' => $house->id,
                'name' => $house->name,
                'location' => $house->location,
                'category_id' => $house->category_id,
            ],
            'categoryOptions' => $categoryOptions,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Data\Models\House  $house
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, House $house)
    {
        // validate
        $attributes = $request->validate([
            'name' => 'required|max:60',
            'location' => 'required',
            'category_id' => 'required',
        ]);

        // create a house
        $house->update($attributes);

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
        $house->delete();

        return redirect()->route('houses.index');
    }
}
