<?php

namespace App\Http\Requests\Frontend\Message;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Routing\Redirector;

class MessageRequest extends FormRequest
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
            'email'=>'required|email',
            'name'=>'required',
            'msg'=>'required'
        ];
    }

    protected function getRedirectUrl()
    {
        $url = $this->redirector->getUrlGenerator();
        $this->redirect = request()->redirect;
        if ($this->redirect) {
            return $url->to($this->redirect);
        }

        return $url->previous();
    }
}
