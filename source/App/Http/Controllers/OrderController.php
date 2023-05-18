<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Libraries\Request\Request;

class OrderController extends Controller
{

    public function index(Request $request)
    {
        $q = $request->get('q');
        $builder = '
            SELECT orders.*, users.name, users.email FROM orders 
            LEFT JOIN users ON orders.customer_id = users.id
        ';
        if (isset($q)) {
            $builder .= "WHERE
                users.id LIKE '%$q%' OR
                users.name LIKE '%$q%' OR
                users.email LIKE '%$q%' OR
                orders.id LIKE '%$q%' OR
                orders.total LIKE '%$q%' OR
                orders.bank_code LIKE '%$q%' OR
                orders.transaction_code LIKE '%$q%'
            ";
        }
        $orders = (new Order)->rawPaginate("$builder ORDER BY ordered_at DESC", 15);

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