<?php

namespace App\Http\Requests\Movie;

use Libraries\Request\Form\FormRequest;

class MovieRequest extends FormRequest
{

    public function rules()
    {
        $is_update = str_contains($this->url, 'update');

        return [
            'name' => function ($value) {
                if ($value === '') {
                    return $this->fail('Name can not be empty');
                }
            },
            'description' => function ($value) {
                if ($value === '') {
                    return $this->fail('Description can not be empty');
                }
            },
            'duration' => function ($value) {
                if ($value === '') {
                    return $this->fail('Duration can not be empty');
                }
            },
            'directors' => function ($value) {
                if ($value === '') {
                    return $this->fail('Directors can not be empty');
                }
            },
            'actors' => function ($value) {
                if ($value === '') {
                    return $this->fail('Actors can not be empty');
                }
            },
            'category' => function ($value) {
                if ($value === '') {
                    return $this->fail('Category can not be empty');
                }
            },
            'premiered_date' => function ($value) {
                if ($value === '') {
                    return $this->fail('Premiere date can not be empty');
                }
            },
            'banner' => function ($value) use ($is_update) {
                if ($value['error'] === 4) {
                    if ($is_update) {
                        $this->merge(['banner' => null]);
                    } else {
                        return $this->fail('Banner can not be empty');
                    }
                }
            },
            'trailer' => function ($value) {
                if ($value === '') {
                    return $this->fail('Trailer can not be empty');
                }
            },
        ];
    }


}