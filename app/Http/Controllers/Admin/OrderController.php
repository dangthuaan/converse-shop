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
        $orders = Order::paginate(config('pagination.order_page_size'));

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deliverOrder($id)
    {
        $currentUser = auth()->user();
        $deliverOrder = $this->orderService->updateOrderStatus($id);
        $this->orderService->sendOrderSuccessEmail($currentUser);

        if ($deliverOrder) {
            return redirect('admin/orders')->with('success', 'Delivered success!');
        }

        return back()->with('error', 'Delivery failed!');
    }
}
