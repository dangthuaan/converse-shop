<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use App\Product;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::with('products')->get();

        return view('client.orders.index', compact('orders'));
    }

    /**
     * Count total price
     *
     * @param  App\Order $order
     * @return int $totalPrice
     */
    public function calTotalPrice($order)
    {
        $totalPrice = 0;

        foreach ($order->products as $orderProduct) {
            $totalPrice += $orderProduct->price * $orderProduct->pivot->quantity;
        }

        return $totalPrice;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\OrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $productId = $request->product_id;
        $product = Product::findOrFail($productId);
        $currentUserId = auth()->id();

        if (session()->has('product_data')) {
            $productData = session('product_data');
        } else {
            $productData = [];
        }

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
        } catch (\Exception $e) {
            \Log::error($e);

            $result = [
                'status' => false,
                'quantity' => 0,
            ];

            return response()->json($result);
        }

        $quantity = array_sum(array_column($productData,'quantity'));

        $result = [
            'status' => true,
            'quantity' => $quantity,
        ];

        $orderData = [
            'user_id' => $currentUserId,
            'total_price' => $product->price,
            'quantity' => $quantity,
        ];

        if (session()->has('order_data')) {
            $orderData['total_price'] = session('order_data.total_price')
                + $product->price;
        }

        session(['order_data' => $orderData]);

        return response()->json($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
