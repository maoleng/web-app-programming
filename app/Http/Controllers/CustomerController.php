<?php

namespace App\Http\Controllers;

use App\Mails\HelloUser;
use App\Models\User;
use Libraries\Request\Request;


class CustomerController extends Controller
{

    public function index()
    {
        $customers = (new User)->where('is_admin', 0)->paginate(5);

        return view('admin.customer.index', [
            'customers' => $customers,
        ]);
    }

}