<?php

namespace App\Http\Requests\Admin\Page;

use App\Http\Requests\Admin\BackendRequest as FormRequest;

class PageRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'brief' => 'required',
            'content' => 'required',
            'images' => 'required',
            'image' => 'required'
        ];
    }
}
