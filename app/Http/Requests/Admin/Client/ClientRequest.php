<?php

namespace App\Http\Requests\Admin\Client;

use App\Http\Requests\Admin\BackendRequest as FormRequest;

class ClientRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'required'
        ];
    }
}
