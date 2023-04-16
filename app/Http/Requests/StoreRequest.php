<?php

namespace App\Http\Requests;

use Libraries\Request\Form\FormRequest;

class StoreRequest extends FormRequest
{

    public function rules()
    {
        return [
            'name' => function ($value) {
                $this->merge([
                    'name' => '123',
                    'bdbf' => 'bb'
                ]);
                if ($value === '') {
                    return $this->fail('Name must not be empty');
                }

                return true;
            },
            'email' => function ($value) {
                return true;
            }
        ];
    }


}