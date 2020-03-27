<?php

namespace App\Http\Requests\Admin\Sample;

use Illuminate\Foundation\Http\FormRequest;

class SampleRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'title'=>'required',
            'intro'=>'required',
            'desc'=>'required',
            'image'=>'required',
        ];
    }
}
