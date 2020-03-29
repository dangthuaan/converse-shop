<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\OrderService;
use App\Http\Requests\OrderRequest;
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
        $productSession = $this->orderService->getProductSession();
        $orderSession = session('order_session');

        $productImage = Product::whereIn('id', array_keys($productSession))->get()->pluck('first_image', 'id');

        $data = [
            'productImage' => $productImage,
            'product_session' => $productSession,
            'order_session' => $orderSession,
        ];

        return view('client.orders.index', $data);
    }

    /**
     * Add a product to Cart.
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
     * Add a product to Cart from Single product page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addToCartSingle(Request $request)
    {
        $productId = $request->product_id;
        $productNumber = $request->product_number;

        $orderSession = $this->orderService->createSingleOrderSession($productId, $productNumber);

        $result = [
            'status' => false,
            'quantity' => $productNumber,
        ];

        if (!empty($orderSession)) {
            $result = [
                'status' => true,
                'quantity' => $productNumber,
            ];
        }

        return response()->json($result);
    }

    /**
     * Destroy a product in Order list.
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
     * Increase product quantity in order.
     *
     * @param  \App\Http\Requests\Request $request
     * @return \Illuminate\Http\Response
     */
    public function increaseQuantity(Request $request)
    {
        $productId = $request->product_id;
        $this->orderService->increaseQuantity($productId);

        return response()->json([
            'status' => true,
        ]);
    }

    /**
     * Decrease product quantity in order.
     *
     * @param  \App\Http\Requests\Request $request
     * @return \Illuminate\Http\Response
     */
    public function decreaseQuantity(Request $request)
    {
        $productId = $request->product_id;

        $this->orderService->decreaseQuantity($productId);

        return response()->json([
            'status' => true,
        ]);
    }

    /**
     * Checkout order: list all products in order.
     *
     * @return \Illuminate\Http\Response
     */
    public function confirmation()
    {
        $productSession = session('product_session');
        $orderSession = session('order_session');

        return view('client.orders.confirmation', compact('productSession', 'orderSession'));
    }

    /**
     * Checkout order and Store order data in database.
     *
     * @param  \App\Http\Requests\OrderRequest $request
     * @return \Illuminate\Http\Response
     */
    public function checkout(OrderRequest $request)
    {
        $contactData = $request->only([
            'address',
            'phone_number'
        ]);

        $currentUser = auth()->user();
        $currentUserId = $currentUser->id;

        if (session('order_session')) {
            $storeOrderProduct = $this->orderService->storeOrderProduct($currentUserId, $contactData);
        }

        if (!empty($storeOrderProduct)) {
            $order = $currentUser->orders()->latest()->first();

            $this->orderService->sendOrderConfirmEmail($currentUser, $order);
            session()->forget(['product_session', 'order_session']);
        }

        return view('client.orders.checkout');
    }
}
