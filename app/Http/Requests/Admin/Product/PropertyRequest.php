<?php

namespace App\Http\Requests\Admin\Product;

use App\Http\Requests\Admin\BackendRequest as FormRequest;

class PropertyRequest extends FormRequest
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
            'property_category_id' => 'required'
        ];
    }
}
