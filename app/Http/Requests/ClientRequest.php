<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
            'client_name' => 'required|string',
            'sex' => 'required|string',
            'mobile' => 'required|numeric|digits:10',
            'transformation_plan' => 'required',
            'expiry_date' => 'required|date',
            'reference_input' => 'sometimes|string'
        ];
    }

    public function messages()
    {
        return [
            'client_name.required' => 'The name is required.',
            'transformation_plan.required' => 'The Objectives is required.',
            'reference_input.sometimes' =>'The Reference input is required.'
        ];
    }
}