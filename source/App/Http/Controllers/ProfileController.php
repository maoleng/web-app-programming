<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;

class ProfileController extends Controller
{

    public function index()
    {
        return view('customer.profile');
    }

    public function update(UpdateProfileRequest $request): void
    {
        $data = $request->validated();
        $update_data = ['name' => $data['name']];
        if ($data['new_password'] !== '') {
            $update_data['password'] = password_hash($data['new_password'], PASSWORD_DEFAULT);
        }

        (new User)->where('id', authed()->id)->update($update_data);
        authed()->name = $data['name'];

        redirectBackWithSuccess('Update profile successfully');
    }

}