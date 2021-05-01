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
        $rule = [
            'client_id' => 'required',
            'offer_range' => 'required',
        ];
        switch (strtolower($this->method())) {
            case 'post':
            {
                return $rule;
            }
            case 'patch':
            {
                return array_merge($rule, [
                    'items' => 'required',
                ]);
            }
        }

    }

    public function attributes()
    {
        return [
            'client_id' => '客户',
            'offer_range' => '报价时效',
        ];
    }
}
