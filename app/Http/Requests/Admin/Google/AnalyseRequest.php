<?php

namespace App\Http\Requests\Admin\Google;

use Illuminate\Foundation\Http\FormRequest;

class AnalyseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'start'=>['required','date'],
            'end'=>['required','date'],
        ];
    }
    public function attributes()
    {
        return [
            'start'=>'开始日期',
            'end'=>'结束日期',
        ];
    }
}
