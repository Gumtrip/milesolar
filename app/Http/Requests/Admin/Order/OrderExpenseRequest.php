<?php

namespace App\Http\Requests\Admin\Order;

use App\Http\Requests\Admin\BackendRequest as FormRequest;

class OrderExpenseRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rule = [
            'title' => 'required',
            'total_amount' => 'required|numeric',
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
