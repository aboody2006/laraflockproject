<?php

namespace App\Http\Controllers\Transactions;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Transactions\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseDashboardController;

class OrdersController extends BaseDashboardController
{
    public function index()
    {
        $completedOrders = Order::orders(Order::COMPLETE_ORDER);

        return view('dashboard.transactions.orders.table.index', ['orders' => $completedOrders, 'view' => 'completed']);
    }

    public function createOrder()
    {
        $customers = Customer::all();

        return view('dashboard.transactions.orders.create.index', ['customers' => $customers]);
    }

    public function setCustomerToNewOrder(Request $request)
    {
        if (!isset($request->customers))
        {
            Flush::error('Customer was not select');

            return redirect()->route('transactions.orders.create.index');
        }

        $order = new Order();
        $order->customers_id = $request->customers;
        $order->created_at = date('d/m/Y g.i A');
        $order->save();

        return redirect()->route('transactions.orders.create.select.product', ['orderId' => $order->id]);
    }

    public function selectProduct($orderId)
    {
        $products = Product::all();

        return view('dashboard.transactions.orders.create.select-product', ['products' => $products, 'orderId' => $orderId]);
    }

    public function saveOrder(Request $request)
    {
        $order = Order::find($request->orderId);

        if (!is_null($order))
        {
            if (isset($request->products))
            {
                $order->products_id = $request->products;
            }

            if (isset($request->rate))
            {
                $order->rate = $request->rate;
            }

            if (isset($request->qty))
            {
                $order->qty = $request->qty;
            }

            $order->save();
        }

        return redirect()->route('transactions.orders.pending.index');
    }

    public function editPendingOrder($orderId)
    {
        $order = Order::find($orderId);
        $products = Product::all();

        return view('dashboard.transactions.orders.table.edit', ['order' => $order, 'products' => $products]);
    }

    public function pendingOrders()
    {
        $pendingOrders = Order::orders(Order::PENDING_ORDER);

        return view('dashboard.transactions.orders.table.index', ['orders' => $pendingOrders, 'view' => 'pending']);
    }

    public function showOrder($orderId)
    {
        $order = Order::find($orderId);
        $order['product'] = $order->product;
        $order['customer'] = $order->customer;

        return view('dashboard.transactions.orders.table.show', ['order' => $order]);
    }
}