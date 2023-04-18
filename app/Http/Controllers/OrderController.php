<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Libraries\Request\Request;

class OrderController extends Controller
{

    public function index()
    {
        $orders = (new Order)->rawPaginate('
            SELECT orders.*, users.name, users.email FROM orders 
                LEFT JOIN users ON orders.customer_id = users.id 
            ORDER BY ordered_at DESC'
        , 5);
        $status = (new Order)->getStatus();

        return view('admin.order.index', [
            'orders' => $orders,
            'status' => $status,
        ]);
    }

    public function show(Request $request, $id): void
    {
        $result = (new Order)->raw("
            SELECT name, category, amount, order_detail.price, (amount * order_detail.price) as `sum`, orders.total FROM orders 
                LEFT JOIN order_detail ON order_detail.order_id = orders.id
                LEFT JOIN tickets ON tickets.id = order_detail.ticket_id
                LEFT JOIN schedules ON schedules.id = tickets.schedule_id
                LEFT JOIN movies ON movies.id = schedules.movie_id
            WHERE orders.id = $id
        ");

        response()->json(array_column($result, 'attributes'));
    }

    public function updatePayment(Request $request): void
    {
        $order = (new Order)->findOrFail($request->get('id'));
        $order->update(['is_paid' => 1]);

        redirectBackWithSuccess('Update payment successfully');
    }

    public function updateStatus(Request $request): void
    {
        $data = $request->all();
        $order = (new Order)->findOrFail($data['id']);
        $order->update(['status' => $data['status']]);

        redirectBackWithSuccess('Update payment successfully');
    }

}