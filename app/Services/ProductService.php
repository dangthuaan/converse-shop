<?php

namespace App\Services;

use App\ProductController;
use Illuminate\Support\Facades\Log;
use App\Traits\UploadTrait;
use Illuminate\Support\Facades\Auth;
use App\Product;
use App\Category;

class ProductService
{
    use UploadTrait;
    /**
     * Get Product by Id.
     *
     * @param  int  $id
     * @return Model
     */
    public function getProductById($id)
    {
        return Product::findOrFail($id);
    }

    /**
     * Save Images.
     *
     * @param  Array $data
     * @return Boolean
     */
    public function saveImage($files)
    {
        $arr_images = [];
        foreach ($files as $image) {
            // Make a image name based on user name and current timestamp
            // Define folder path
            $folder = 'img/';
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $image->getClientOriginalName();
            // Upload image
            $this->uploadOne($image, $folder, 'public');
            // Set user profile image path in database to filePath
            $arr_images[] = $filePath;
        }
        $total_images = implode("|", $arr_images);

        return $total_images;
    }

    /**
     * Save Categories.
     *
     * @param  Array $data
     * @return Boolean
     */
    public function saveCategory($categories)
    {
        $arr_categories = [];
        foreach ($categories as $category) {
            $arr_categories[] = $category;
        }
        $total_categories = implode("|", $arr_categories);

        return $total_categories;
    }

    /**
     * Create Product.
     *
     * @param  Array $data
     * @return Boolean
     */
    public function create($data, $category_ids)
    {
        try {
            $product = Product::create($data);
            $product->categories()->attach($category_ids);
        } catch (Exception $e) {
            Log::error($e);

            return false;
        }

        return true;
    }

    /**
     * Update Product by Id.
     *
     * @param  int $id
     * @param  Array $data
     * @return Boolean
     */
    public function update($id, $data)
    {
        //
    }

    /**
     * Delete Product by Id.
     *
     * @param  int $id
     * @return Boolean
     */
    public function delete($id)
    {
        $Product = Product::findOrFail($id);

        try {
            $Product->delete();
        } catch (\Exception $e) {
            Log::error($e);

            return false;
        }

        return true;
    }
}
