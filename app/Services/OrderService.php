<?php

namespace App\Services;

use App\Product;
use Illuminate\Support\Facades\Log;

class OrderService
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
     * Check and get if empty session.
     *
     * @param  int  $id
     * @return Array
     */
    public function getProductSession()
    {
        if (session()->has('product_data')) {
            return session('product_data');
        }

        return [];
    }

    /**
     * create Product session.
     *
     * @param  Int $id
     * @return Array
     */
    public function createProductSession($id)
    {
        $product = $this->getProductById($id);

        $productData = $this->getProductSession();

        try {
            if (array_key_exists($product->id, $productData)) {
                $productData[$product->id]['quantity'] += 1;
            } else {
                $productData[$product->id] = [
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => 1,
                ];
            }
            session(['product_data' => $productData]);
        } catch (\Throwable $th) {
            Log::error($th);

            return [];
        }

        return $productData;
    }

    /**
     * create Order session.
     *
     * @param  Int $id
     * @return Array
     */
    public function createOrderSession($id)
    {
        $product = $this->getProductById($id);
        $currentUserId = auth()->id();

        $productData = $this->createProductSession($id);

        $quantity = array_sum(array_column($productData, 'quantity'));

        $orderData = [
            'user_id' => $currentUserId,
            'total_price' => $product->price,
            'quantity' => $quantity,
        ];

        try {
            if (session()->has('order_data')) {
                $orderData['total_price'] = session('order_data.total_price')
                    + $product->price;
            }
            session(['order_data' => $orderData]);
        } catch (\Throwable $th) {
            Log::error($th);

            return [];
        }

        return $orderData;
    }

    /**
     * Remove a product from Order list.
     *
     * @param  int $id
     * @return Boolean
     */
    public function removeProductData($id)
    {
        $productData = session('product_data');
        $orderData = session('order_data');

        $quantityOfRemoveProduct = $productData[$id]['quantity'];
        $totalPriceOfRemoveProduct = $quantityOfRemoveProduct * $productData[$id]['price'];

        unset($productData[$id]);
        session(['product_data' => $productData]);

        $orderData['total_price'] -= $totalPriceOfRemoveProduct;
        $orderData['quantity'] -= $quantityOfRemoveProduct;
        session(['order_data' => $orderData]);

        if (empty(session('product_data'))) {
            session()->forget(['product_data', 'order_data']);
        }
    }
}
