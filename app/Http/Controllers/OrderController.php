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

        return view('admin.order.index', [
            'orders' => $orders,
        ]);
    }

    public function show(Request $request, $id): void
    {
        $result = (new Order)->raw("
            SELECT movies.name as `movie_name`, combos.name as `combo_name`, image, qr_code,
                   amount, order_detail.price, (amount * order_detail.price) as `sum`, orders.total
            FROM orders 
                LEFT JOIN order_detail ON order_detail.order_id = orders.id
                LEFT JOIN tickets ON tickets.id = order_detail.ticket_id
                LEFT JOIN combos ON combos.id = order_detail.combo_id
                LEFT JOIN schedules ON schedules.id = tickets.schedule_id
                LEFT JOIN movies ON movies.id = schedules.movie_id
            WHERE orders.id = $id
        ");

        response()->json(array_column($result, 'attributes'));
    }

}