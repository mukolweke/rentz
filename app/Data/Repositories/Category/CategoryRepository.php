<?php

namespace App\Data\Repositories\Category;

use App\Data\Models\Category;
use App\Data\Transformers\CategoryTransformer;

/**
 * Class CategoryRepository
 * @package App\Data\Repositories\Category
 */
class CategoryRepository implements InterfaceCategoryRepository
{
    /**
     * Retrieve all resource in storage.
     *
     * @param  Boolean  $paginate
     */
    public function getAll($paginate = false)
    {
        $categoriesQ = Category::latest('id');

        $categories = $paginate ? $categoriesQ->paginate(10) : $categoriesQ->get();

        CategoryTransformer::transformCollection($categories);
        return $categories;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  Array  $attributes
     */
    public function store($attributes)
    {
        Category::create($attributes);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Array  $attributes
     * @param  \App\Data\Models\Category  $category
     */
    public function update($attributes, $category)
    {
        $category->update(['name' => $attributes['name']]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Data\Models\Category  $category
     */
    public function delete($category)
    {
        $category->delete();
    }
}
