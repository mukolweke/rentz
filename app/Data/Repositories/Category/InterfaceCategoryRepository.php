<?php

namespace App\Data\Repositories\Category;

/**
 * Interface CategoryRepository
 * @package App\Data\Repositories\Category
 */
interface InterfaceCategoryRepository
{
    /**
     * Retrieve all resource in storage.
     *
     * @param  Boolean  $paginate
     */
    public function getAll($paginate = false);

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
     * @param  \App\Data\Models\Category  $category
     */
    public function update($attributes, $category);

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Data\Models\Category  $category
     */
    public function delete($category);
}
