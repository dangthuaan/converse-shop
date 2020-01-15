<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\OrderService;
use App\Product;
use App\Order;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productData = $this->orderService->getProductSession();
        $orderData = session('order_data');

        $productImage = Product::whereIn('id', array_keys($productData))->get()->pluck('first_image', 'id');

        $data = [
            'productImage' => $productImage,
            'product_data' => $productData,
            'order_data' => $orderData,
        ];

        return view('client.orders.index', $data);
    }

    /**
     * Add a product to Cart
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addToCart(Request $request)
    {
        $productId = $request->product_id;

        $orderSession = $this->orderService->createOrderSession($productId);

        $result = [
            'status' => false,
            'quantity' => 0,
        ];

        if (!empty($orderSession)) {
            $result = [
                'status' => true,
                'quantity' => $orderSession['quantity'],
            ];
        }

        return response()->json($result);
    }

    /**
     * Destroy a product in Order list
     *
     * @param  \App\Http\Requests\Request $request
     * @return \Illuminate\Http\Response
     */
    public function removeProductInCart(Request $request)
    {
        $productId = $request->product_id;

        $this->orderService->removeProductData($productId);

        return response()->json([
            'status' => true,
        ]);
    }

    /**
     * Increase product quantity in order
     *
     * @param  \App\Http\Requests\Request $request
     * @return \Illuminate\Http\Response
     */
    public function plusQuantity(Request $request)
    {
        $productId = $request->product_id;
        $this->orderService->increaseQuantity($productId);

        return response()->json([
            'status' => true,
        ]);
    }

    /**
     * Decrease product quantity in order
     *
     * @param  \App\Http\Requests\Request $request
     * @return \Illuminate\Http\Response
     */
    public function minusQuantity(Request $request)
    {
        $productId = $request->product_id;

        $this->orderService->decreaseQuantity($productId);

        return response()->json([
            'status' => true,
        ]);
    }
}
