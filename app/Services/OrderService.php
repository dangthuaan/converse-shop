<?php

namespace App\Services;

use App\Product;
use App\Order;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmation;
use App\Mail\OrderSuccess;

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
        if (session()->has('product_session')) {
            return session('product_session');
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

        $productSession = $this->getProductSession();

        try {
            if (array_key_exists($product->id, $productSession)) {
                $productSession[$product->id]['quantity'] += 1;
            } else {
                $productSession[$product->id] = [
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => 1,
                ];
            }
            session(['product_session' => $productSession]);
        } catch (\Throwable $th) {
            Log::error($th);

            return [];
        }

        return $productSession;
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

        $productSession = $this->createProductSession($id);

        $quantity = array_sum(array_column($productSession, 'quantity'));

        $orderData = [
            'user_id' => $currentUserId,
            'total_price' => $product->price,
            'quantity' => $quantity,
        ];

        try {
            if (session()->has('order_session')) {
                $orderData['total_price'] = session('order_session.total_price')
                    + $product->price;
            }
            session(['order_session' => $orderData]);
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
        $productSession = session('product_session');
        $orderSession = session('order_session');

        $quantityOfRemoveProduct = $productSession[$id]['quantity'];
        $totalPriceOfRemoveProduct = $quantityOfRemoveProduct * $productSession[$id]['price'];

        unset($productSession[$id]);
        session(['product_session' => $productSession]);

        $orderSession['total_price'] -= $totalPriceOfRemoveProduct;
        $orderSession['quantity'] -= $quantityOfRemoveProduct;
        session(['order_session' => $orderSession]);

        if (empty(session('product_session'))) {
            session()->forget(['product_session', 'order_session']);
        }
    }

    /**
     * Increase product quantity.
     *
     * @param  int $id
     */
    public function increaseQuantity($id)
    {
        $productSession = session('product_session');
        $orderSession = session('order_session');

        $productSession[$id]['quantity']++;
        session(['product_session' => $productSession]);

        $orderSession['total_price'] += $productSession[$id]['price'];
        $orderSession['quantity']++;
        session(['order_session' => $orderSession]);
    }

    /**
     * Decrease product quantity.
     *
     * @param  int $id
     */
    public function decreaseQuantity($id)
    {
        $productSession = session('product_session');
        $orderSession = session('order_session');

        if ($productSession[$id]['quantity'] > 1) {
            $productSession[$id]['quantity']--;
            session(['product_session' => $productSession]);

            $orderSession['total_price'] -= $productSession[$id]['price'];
            $orderSession['quantity']--;
            session(['order_session' => $orderSession]);
        }
    }

    /**
     * Store order in database.
     *
     * @param  int $userId
     */
    public function storeOrderProduct($userId)
    {
        $productSession = session('product_session');
        $orderSession = session('order_session');

        $productId = array_keys($productSession);
        $products = Product::findOrFail($productId);

        $orderData = [
            'user_id' => $userId,
            'total_price' => $orderSession['total_price'],
            'quantity' => $orderSession['quantity'],
            'status' => config('order.new_order_status'),
        ];

        try {
            $order = Order::create($orderData);

            foreach ($products as $product) {
                $productData = [
                    'product_id' => $product->id,
                    'quantity' => $productSession[$product->id]['quantity'],
                    'price' => $product->price,
                ];

                $product->orders()->attach($order->id, $productData);
            }
        } catch (\Throwable $th) {
            Log::error($th);

            return false;
        }

        return true;
    }

    /**
     * Send order confirmation email.
     *
     * @param  int $user
     * @param  array $order
     */
    public function sendOrderConfirmEmail($user, $order)
    {
        try {
            Mail::to($user)->send(new OrderConfirmation($order));
        } catch (\Throwable $th) {
            Log::error($th);

            return false;
        }

        return true;
    }

    /**
     * Send order success email.
     *
     * @param  int $user
     */
    public function sendOrderSuccessEmail($user)
    {
        try {
            Mail::to($user)->send(new OrderSuccess());
        } catch (\Throwable $th) {
            Log::error($th);

            return false;
        }

        return true;
    }

    /**
     * Update Order status.
     *
     * @param  int $id
     */
    public function updateOrderStatus($id)
    {
        $order = Order::findOrFail($id);
        try {
            $order->increment('status');
        } catch (\Throwable $th) {
            Log::error($th);

            return false;
        }

        return true;
    }
}
