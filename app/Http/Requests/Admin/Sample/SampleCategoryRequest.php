<?php

namespace App\Http\Requests\Admin\Sample;

use App\Http\Requests\Admin\BackendRequest as FormRequest;

class SampleCategoryRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title'=>'required'
        ];
    }
}
