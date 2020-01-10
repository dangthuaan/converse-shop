<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\OrderService;
use App\Order;
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
        $orders = Order::with('products')->get();

        return view('client.orders.index', compact('orders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $productId = $request->product_id;
        $product = $this->orderService->getProductById($productId);
        $currentUserId = auth()->id();

        $productData = $this->orderService->createProductSession($productId);

        $quantity = array_sum(array_column($productData,'quantity'));

        $orderData = [
            'user_id' => $currentUserId,
            'total_price' => $product->price,
            'quantity' => $quantity,
        ];

        $createOrderSession = $this->orderService->createOrderSession($productId, $orderData);

        $result = [
            'status' => false,
            'quantity' => 0,
        ];

        if ($productData && $createOrderSession) {
            $result = [
                'status' => true,
                'quantity' => $quantity,
            ];
        }

        return response()->json($result);
    }
}
