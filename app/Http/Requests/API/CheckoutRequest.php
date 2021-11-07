<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
            'name' => 'required|max:84',
            'email' => 'required|email|max:112',
            'phone' => 'required|max:14',
            'address' => 'required',
            'total' => 'required',
            'status' => 'nullable|in:SUCCESS,FAILED,PENDING',
            'details' => 'required|array',
            'details.*' => 'exists:products,id',
        ];
    }
}
