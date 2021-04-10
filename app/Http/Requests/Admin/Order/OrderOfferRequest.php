<?php

namespace App\Http\Requests\Admin\Order;

use App\Http\Requests\Admin\BackendRequest as FormRequest;

class OrderOfferRequest extends FormRequest
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
            'offer_range' => 'required',
            'client_info' => 'required',
            'term' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'client_id' => '客户',
            'offer_range' => '报价时效区间',
            'client_info' => '客户信息',
            'term' => '条款',
        ];
    }
}
