<?php

namespace App\Http\Requests\Admin\Order;

use App\Http\Requests\Admin\BackendRequest as FormRequest;

class OrderProceedRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rule = [
            'currency' => 'required',
            'total_amount' => 'required',
            'exchange_rate' => 'required',
        ];
        switch (strtolower($this->method())) {
            case 'post':
                return array_merge([
                    'order_id' => 'required'
                ], $rule);
                break;
            case 'patch':
                return $rule;
                break;

            default:
                return [];
        }
    }
}
