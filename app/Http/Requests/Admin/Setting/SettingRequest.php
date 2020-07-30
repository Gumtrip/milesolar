<?php

namespace App\Http\Requests\Admin\Setting;

use App\Http\Requests\Admin\BackendRequest as FormRequest;

class SettingRequest extends FormRequest
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
            'category_id'=>'required',
            'type'=>'required',
        ];
    }
    public function attributes()
    {
        return [
            'title'=>'标题',
            'category_id'=>'分类',
            'type'=>'类型',
        ];
    }
}
