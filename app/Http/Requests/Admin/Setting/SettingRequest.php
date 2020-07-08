<?php

namespace App\Http\Requests\Admin\Setting;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'title'=>'required',
            'category_id'=>'required',
            'value'=>'required',
        ];
    }
    public function attributes()
    {
        return [
            'title'=>'标题',
            'category_id'=>'分类',
            'value'=>'值',
        ];
    }
}
