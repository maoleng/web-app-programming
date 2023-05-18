<?php

namespace App\Http\Controllers;

use App\Models\User;
use Libraries\Request\Request;

class CustomerController extends Controller
{

    public function index(Request $request)
    {
        $q = $request->get('q');
        $builder = 'SELECT * FROM users WHERE is_admin = 0 ';
        if (isset($q)) {
            $builder .= "AND
                name LIKE '%$q%' OR
                email LIKE '%$q%'
            ";
        }
        $customers = (new User)->rawPaginate("$builder ORDER BY created_at DESC", 15);

        return view('admin.customer.index', [
            'customers' => $customers,
        ]);
    }

}