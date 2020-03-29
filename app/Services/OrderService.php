<?php

namespace App\Services;

use App\Product;
use App\Order;
use App\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmation;
use App\Mail\OrderSuccess;
use App\Mail\OrderClose;

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
                    'sale' => $product->sale,
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
            'total_price' => $product->price - ($product->price * $product->sale) / 100,
            'quantity' => $quantity,
        ];

        try {
            if (session()->has('order_session')) {
                $orderData['total_price'] = session('order_session.total_price')
                    + ($product->price - ($product->price * $product->sale / 100));
            }
            session(['order_session' => $orderData]);
        } catch (\Throwable $th) {
            Log::error($th);

            return [];
        }

        return $orderData;
    }

    /**
     * create Single Product session.
     *
     * @param  Int $id
     * @return Array
     */
    public function createSingleProductSession($id, $productNumber)
    {
        $product = $this->getProductById($id);

        $productSession = $this->getProductSession();

        try {
            $productSession[$product->id] = [
                'name' => $product->name,
                'price' => $product->price,
                'sale' => $product->sale,
                'quantity' => $productNumber,
            ];
            session(['product_session' => $productSession]);
        } catch (\Throwable $th) {
            Log::error($th);

            return [];
        }

        return $productSession;
    }

    /**
     * create Single Order session.
     *
     * @param  Int $id
     * @return Array
     */
    public function createSingleOrderSession($id, $productNumber)
    {
        $product = $this->getProductById($id);
        $currentUserId = auth()->id();

        $productSession = $this->createSingleProductSession($id, $productNumber);

        $quantity = array_sum(array_column($productSession, 'quantity'));

        $orderData = [
            'user_id' => $currentUserId,
            'total_price' => $product->price - ($product->price * $product->sale) / 100,
            'quantity' => $quantity,
        ];

        try {
            if (session()->has('order_session')) {
                $orderData['total_price'] = session('order_session.total_price')
                    + ($product->price - ($product->price * $product->sale) / 100);
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

        $orderSession['total_price'] += $productSession[$id]['price'] - ($productSession[$id]['price'] * $productSession[$id]['sale']) / 100;
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

            $orderSession['total_price'] -= $productSession[$id]['price'] - ($productSession[$id]['price'] * $productSession[$id]['sale']) / 100;
            $orderSession['quantity']--;
            session(['order_session' => $orderSession]);
        }
    }

    /**
     * Store order in database.
     *
     * @param  int $userId
     */
    public function storeOrderProduct($userId, $data)
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
            'address' => $data['address'],
            'phone_number' => $data['phone_number'],
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
     * @param object $order
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
     * Update Order in progress status.
     *
     * @param  int $id
     */
    public function deliverOrder($id)
    {
        $order = Order::findOrFail($id);
        try {
            $order->update(['status' => 2]);
            $this->sendOrderSuccessEmail(User::findOrFail($order->user_id));
        } catch (\Throwable $th) {
            Log::error($th);

            return false;
        }

        return true;
    }

    /**
     * Update Order delivered status.
     *
     * @param  int $id
     */
    public function confirmOrder($id)
    {
        $order = Order::findOrFail($id);
        try {
            $order->update(['status' => 3]);
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
    public function sendOrderSuccessEmail($userId)
    {
        try {
            Mail::to(User::findOrFail($userId))->send(new OrderSuccess());
        } catch (\Throwable $th) {
            Log::error($th);

            return false;
        }

        return true;
    }

    /**
     * Update Order close status.
     *
     * @param  int $id
     */
    public function closeOrder($id, $closeReason)
    {
        $order = Order::findOrFail($id);
        try {
            $order->update(['status' => 4]);
            $this->sendOrderCloseEmail(User::findOrFail($order->user_id), $closeReason);
        } catch (\Throwable $th) {
            Log::error($th);

            return false;
        }

        return true;
    }

    /**
     * Send order close email.
     *
     * @param  int $user
     */
    public function sendOrderCloseEmail($userId, $reason)
    {
        try {
            Mail::to(User::findOrFail($userId))->send(new OrderClose($reason));
        } catch (\Throwable $th) {
            Log::error($th);

            return false;
        }

        return true;
    }
}
