<?php

namespace App\Http\Requests\Admin\Order;

use App\Http\Requests\Admin\BackendRequest as FormRequest;

class OrderRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'client_id'=>'required',
            'total_amount'=>'required',
            'currency'=>'required',
            'exchange_rate'=>'required',
            'rmb_total_amount'=>'required',
        ];
    }
}
