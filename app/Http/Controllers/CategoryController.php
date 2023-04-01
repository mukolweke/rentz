<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Data\Models\Category;
use App\Data\Repositories\Category\CategoryRepository;
use App\Http\Requests\CategoryPostRequest;

class CategoryController extends Controller
{
    protected static $unitsHomeUrl = '/category';
    /**
     * CategoryController constructor.
     * @param CategoryRepository $categoryRepo
     */
    public function __construct(
        protected CategoryRepository $categoryRepo,
    ) {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Category/Index', [
            'categories' => $this->categoryRepo->getAll(true),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryPostRequest $request)
    {
        // valid request
        $attributes = $request->safe()->only(['name']);

        // Create the category
        $this->categoryRepo->store($attributes);

        // redirect
        return redirect(self::$unitsHomeUrl);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Data\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryPostRequest $request, Category $category)
    {
        // valid request
        $attributes = $request->safe()->only(['name']);

        // update the category
        $this->categoryRepo->update($attributes, $category);

        // redirect
        return redirect(self::$unitsHomeUrl);
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
        $this->categoryRepo->delete($category);

        // redirect
        return redirect(self::$unitsHomeUrl);
    }
}
