<?php

namespace App\Http\Controllers;

use App\Mails\HelloUser;
use Libraries\Request\Request;


class PostController extends Controller
{
    /**
     * @throws \PHPMailer\PHPMailer\Exception
     */
    public function index()
    {
//        $data = [
//            'to' => 'feature453@gmail.com',
//            'bcc' => [
//                'feature455@gmail.com',
//                'feature456@gmail.com',
//            ],
//            'cc' => [
//                'feature45@gmail.com',
//            ],
//            'view_name' => 'mail',
//            'view_data' => [
//                'name' => 'Lokkk'
//            ],
//        ];
//        $mail = new HelloUser($data);
//        dd($mail->send());
        return view('post_detail');
    }

    public function show(Request $request)
    {
        dd($request);
    }

    public function store(Request $request)
    {
        dd($request->input());
        echo 'den tu postcontroller@store';
    }

    public function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

}