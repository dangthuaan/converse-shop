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
        $orders = Order::with('products')->orderBy('created_at', 'desc')->paginate(config('pagination.order_page_size'));

        $newOrders = Order::with('products')->where('status', 1)->orderBy('created_at', 'desc')->paginate(config('pagination.order_page_size'));
        $inProgressOrders = Order::with('products')->where('status', 2)->orderBy('created_at', 'desc')->paginate(config('pagination.order_page_size'));
        $deliveredOrders = Order::with('products')->where('status', 3)->orderBy('created_at', 'desc')->paginate(config('pagination.order_page_size'));
        $closedOrders = Order::with('products')->where('status', 4)->orderBy('created_at', 'desc')->paginate(config('pagination.order_page_size'));

        return view('admin.orders.index', compact('orders', 'newOrders', 'inProgressOrders', 'deliveredOrders', 'closedOrders'));
    }

    /**
     * Update order status(deliver).
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deliverOrder($id)
    {
        $deliverOrder = $this->orderService->deliverOrder($id);

        if ($deliverOrder) {
            return redirect('admin/orders')->with('success', 'Delivered success!');
        }

        return back()->with('error', 'Delivery failed!');
    }

    /**
     * Update order status(deliver).
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirmDeliver($id)
    {
        $confirmOrder = $this->orderService->confirmOrder($id);

        if ($confirmOrder) {
            return redirect('admin/orders')->with('success', 'Delivered success!');
        }

        return back()->with('error', 'Delivery failed!');
    }

    /**
     * Confirm close order.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirmClose($id)
    {
        $order = Order::findOrFail($id);

        return view('admin.orders.confirmClose', compact('order'));
    }

    /**
     * Update order status(close).
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function closeOrder(Request $request, $id)
    {
        $closeReason = $request->close_reason;

        $closeOrder = $this->orderService->closeOrder($id, $closeReason);

        if ($closeOrder) {
            return redirect('admin/orders')->with('success', 'Order Closed!');
        }

        return back()->with('error', 'Close failed!');
    }
}
