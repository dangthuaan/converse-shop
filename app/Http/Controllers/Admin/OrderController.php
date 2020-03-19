<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use App\Services\OrderService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        $orders = Order::with('products')->paginate(config('pagination.order_page_size'));

        $inProgressOrders = Order::with('products')->where('status', 1)->paginate(1, ['*'], 'in-progress');
        $deliveredOrders = Order::with('products')->where('status', 2)->paginate(1, ['*'], 'delivered');
        $closedOrders = Order::with('products')->where('status', 3)->paginate(1, ['*'], 'closed');

        return view('admin.orders.index', compact('orders', 'inProgressOrders', 'deliveredOrders', 'closedOrders'));
    }

    /**
     * Update order status(deliver).
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deliverOrder($id)
    {
        $currentUser = auth()->user();
        $deliverOrder = $this->orderService->deliverOrder($id);
        $this->orderService->sendOrderSuccessEmail($currentUser);

        if ($deliverOrder) {
            return redirect('admin/orders')->with('success', 'Delivered success!');
        }

        return back()->with('error', 'Delivery failed!');
    }

    /**
     * Update order status(close).
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function closeOrder($id)
    {
        $closeOrder = $this->orderService->closeOrder($id);

        if ($closeOrder) {
            return redirect('admin/orders')->with('success', 'Order Closed!');
        }

        return back()->with('error', 'Close failed!');
    }
}
