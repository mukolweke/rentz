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
     * @param  \App\Data\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        // Validate the request
        $attributes = $request->validate([
            'name' => 'required',
        ]);

        // update the category
        $category->update(['name' => $attributes['name']]);
        // dd('updated', $category->fresh());
        // redirect
        return redirect('/units');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Data\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //TODO we should check if unit is attached, cant' delete

        // delete action
        $category->delete();

        // redirect
        return redirect('/units');
    }
}
