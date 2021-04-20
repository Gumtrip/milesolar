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
            'client_id' => 'required',
            'total_amount' => 'required',
            'currency' => 'required',
            'exchange_rate' => 'required',
        ];
    }
    public function attributes()
    {
        return [
            'client_id' => '客户',
            'total_amount' => '订单总价',
            'currency' => '币种',
            'exchange_rate' => '汇率',
        ];
    }
}
