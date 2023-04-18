<?php

namespace App\Http\Controllers;

use App\Models\Order;

class OrderController extends Controller
{

    public function index()
    {
        $orders = (new Order)->rawPaginate('
            SELECT * FROM orders 
                LEFT JOIN users on orders.customer_id = users.id 
            order by ordered_at desc'
        , 5);
        $status = (new Order)->getStatus();

        return view('admin.order.index', [
            'orders' => $orders,
            'status' => $status,
        ]);
    }

}