<?php

namespace App\Http\Controllers;

use App\Data\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request
        $attributes = $request->validate([
            'name' => 'required',
        ]);

        // Create the category
        Category::create($attributes);

        // redirect
        return redirect('/units');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AppDataModelsCategory  $appDataModelsCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AppDataModelsCategory $appDataModelsCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AppDataModelsCategory  $appDataModelsCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(AppDataModelsCategory $appDataModelsCategory)
    {
        //
    }
}
