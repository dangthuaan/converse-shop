<?php

namespace App\Services;

use App\ProductController;
use Illuminate\Support\Facades\Log;
use App\Traits\UploadTrait;
use Illuminate\Support\Facades\Auth;
use App\Product;
use App\Category;
use Illuminate\Support\Facades\Mail;
use App\Mail\ProductUpdate;

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
     * @param  Array $stringImage
     * @return Boolean
     */
    public function saveImage($files)
    {
        $arrayImage = [];
        foreach ($files as $image) {
            // Make a image name based on user name and current timestamp
            // Define folder path
            $folder = 'img/';
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $image->getClientOriginalName();
            // Upload image
            $this->uploadOne($image, $folder, 'public');
            // Set user profile image path in database to filePath
            $arrayImage[] = $filePath;
        }
        $stringImage = implode('|', $arrayImage);

        return $stringImage;
    }

    /**
     * Save Categories to Products table.
     *
     * @param  Array $stringCategory
     * @return Boolean
     */
    public function getCategoryId($categories)
    {
        $stringCategory = implode('|', $categories);

        return $stringCategory;
    }

    /**
     * Create Product.
     *
     * @param  Array $data
     * @return Boolean
     */
    public function create($data, $categoryIds)
    {
        try {
            $product = Product::create($data);
            $product->categories()->attach($categoryIds);
        } catch (\Exception $e) {
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
    public function update($id, $data, $userFavorites)
    {
        $product = Product::findOrFail($id);

        try {
            $product->update($data);
            $changedProduct = $product->getChanges();
            if (isset($changedProduct['price']) || isset($changedProduct['sale'])) {
                foreach ($userFavorites as $userFavorite) {
                    Mail::to($userFavorite->user)->send(new ProductUpdate());
                }
            }
        } catch (\Exception $e) {
            Log::error($e);

            return false;
        }

        return true;
    }

    /**
     * Delete Product by Id.
     *
     * @param  int $id
     * @return Boolean
     */
    public function delete($id)
    {
        $product = Product::findOrFail($id);

        try {
            $product->delete();
        } catch (\Exception $e) {
            Log::error($e);

            return false;
        }

        return true;
    }
}
