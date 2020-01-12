<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\OrderService;
use App\Product;

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
        $productData = $this->orderService->checkProductSession();


        $productImage = Product::whereIn('id', array_keys($productData))->get()->pluck('first_image', 'id');

        $data = [
            'productImage' => $productImage,
            'product_data' => $productData,
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

        if ($orderSession) {
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

        $removeProduct = $this->orderService->removeProductData($productId);

        $removeFlag = false;

        if ($removeProduct) {
            $removeFlag = true;
        }

        $result = [
            'status' => $removeFlag,
        ];

        return response()->json($result);
    }
}
