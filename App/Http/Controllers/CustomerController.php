<?php

namespace App\Http\Controllers;

use App\Models\User;

class CustomerController extends Controller
{

    public function index()
    {
        $customers = (new User)->where('is_admin', 0)->orderByDesc('created_at')->paginate(5);

        return view('admin.customer.index', [
            'customers' => $customers,
        ]);
    }

}