<?php

namespace App\Http\Requests\Schedule;

use Libraries\Request\Form\FormRequest;

class StoreRequest extends FormRequest
{

    public function rules()
    {
        return [
            'movie_id' => function ($value) {
                if ($value === '') {
                    return $this->fail('Movie can not be empty');
                }
            },
            'started_at' => function ($value) {
                if ($value === '') {
                    return $this->fail('Start date time can not be empty');
                }
            },
            'ended_at' => function ($value) {
                if ($value === '') {
                    return $this->fail('End date time can not be empty');
                }
            },
        ];
    }


}