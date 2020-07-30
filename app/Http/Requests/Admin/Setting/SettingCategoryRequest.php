<?php

namespace App\Http\Requests\Admin\Setting;

use App\Http\Requests\Admin\BackendRequest as FormRequest;

class SettingCategoryRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'=>'required'
        ];
    }
    public function attributes()
    {
        return [
            'title'=>'标题'
        ];
    }
}
