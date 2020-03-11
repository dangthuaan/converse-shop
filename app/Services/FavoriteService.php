<?php

namespace App\Services;

use App\Product;
use App\Favorite;
use Illuminate\Support\Facades\Log;

class FavoriteService
{
    /**
     * Get Order by Id.
     *
     * @param  int  $id
     * @return Model
     */
    public function getProductById($id)
    {
        return Product::findOrFail($id);
    }

    /**
     * Store a newly favorite product.
     *
     * @param  array $data
     * @return Boolean
     */
    public function createFavoriteData($data)
    {
        try {
            Favorite::create($data);
        } catch (\Exception $e) {
            Log::error($e);

            return false;
        }

        return true;
    }

    /**
     * Delete a product from favorite list.
     *
     * @param  int $productId
     * @return Boolean
     */
    public function deleteFavoriteData($userId, $productId)
    {
        $favoriteProduct = Favorite::where([
            'user_id' => $userId,
            'product_id' => $productId,
        ])->firstOrFail();

        try {
            $favoriteProduct->delete();
        } catch (\Exception $e) {
            Log::error($e);

            return false;
        }

        return true;
    }
}
