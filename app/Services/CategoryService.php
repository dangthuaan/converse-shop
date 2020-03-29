<?php

namespace App\Services;

use App\Category;
use Illuminate\Support\Facades\Log;

class CategoryService
{
    /**
     * Get Category by Id.
     *
     * @param  int  $id
     * @return Model
     */
    public function getCategoryById($id)
    {
        return Category::findOrFail($id);
    }

    /**
     * Create Category.
     *
     * @param  Array $data
     * @return Boolean
     */
    public function create($data)
    {
        if ($data['parent_id'] == 0) {
            unset($data['parent_id']);
        } //delete parent_id if is null

        try {
            Category::create($data);
        } catch (\Exception $e) {
            Log::error($e);

            return false;
        }

        return true;
    }

    /**
     * Update Category by Id.
     *
     * @param  int $id
     * @param  Array $data
     * @return Boolean
     */
    public function update($id, $data)
    {
        if ($data['parent_id'] == 0) {
            $data['parent_id'] = null;
        } //delete parent_id if is null

        $category = Category::findOrFail($id);

        try {
            $category->update($data);
        } catch (\Exception $e) {
            Log::error($e);

            return false;
        }

        return true;
    }

    /**
     * Delete Category by Id.
     *
     * @param  int $id
     * @return Boolean
     */
    public function delete($id)
    {
        $category = Category::findOrFail($id);

        try {
            if (is_null($category->parent_id)) {
                Category::where('parent_id', $id)->delete();
            }
            $category->delete();
        } catch (\Exception $e) {
            Log::error($e);

            return false;
        }

        return true;
    }
}
