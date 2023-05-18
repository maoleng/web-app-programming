<?php

namespace App\Http\Requests\Auth;

use Libraries\Request\Form\FormRequest;

class RegisterRequest extends FormRequest
{

    public function rules()
    {
        return [
            'name' => function ($value) {
                if ($value === '') {
                    return $this->fail('Name must not be empty');
                }

                return true;
            },
            'email' => function ($value) {
                if ($value === '') {
                    return $this->fail('Email must not be empty');
                }

                return true;
            },
            'password' => function ($value) {
                if ($value === '') {
                    return $this->fail('Password must not be empty');
                }

                return true;
            },
            're_password' => function ($value) {
                if ($value === '') {
                    return $this->fail('Password must not be empty');
                }
                if ($value !== $this->get('password')) {
                    return $this->fail('Password and retype password does not match');
                }

                return true;
            },

        ];
    }


}