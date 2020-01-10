<?php

namespace App\Services;

use App\Order;
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

    public function checkProductSession()
    {
        if (session()->has('product_data')) {
            return session('product_data');
        }

        return [];
    }

    /**
     * create Product session
     *
     * @param  Int $id
     * @return Boolean
     */
    public function createProductSession($id)
    {
        $product = $this->getProductById($id);

        $productData = $this->checkProductSession();

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

            return false;
        }

        return $productData;
    }

    /**
     * create Order session
     *
     * @param  Int $id
     * @param  Array $orderData
     * @return Boolean
     */
    public function createOrderSession($id, $orderData)
    {
        $product = $this->getProductById($id);

        try {
            if (session()->has('order_data')) {
                $orderData['total_price'] = session('order_data.total_price')
                + $product->price;
            }
            session(['order_data' => $orderData]);
        } catch (\Throwable $th) {
            Log::error($th);

            return false;
        }

        return true;
    }

    /**
     * Delete order by Id.
     *
     * @param  int $id
     * @return Boolean
     */
    public function delete($id)
    {
        $order = Order::findOrFail($id);

        try {
            $order->delete();
        } catch (\Throwable $th) {
            Log::error($th);

            return false;
        }

        return true;
    }
}
