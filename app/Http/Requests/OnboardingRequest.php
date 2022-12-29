<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OnboardingRequest extends FormRequest
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
         'onboarding_date' => 'required|string',
            'date_of_birth' => 'required|string',
            // 'occupation' => 'required|string',
            'address' => 'required|string',
            'height' => 'required|numeric|between:0,299.99',
            'weight' => 'required|numeric|between:0,299.99',
            'client_fee' => 'required|string',
            'coach' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'onboarding_date.required' => 'The Onboarding date is required.',
            'client_fee.required' => 'The Client Fee is required.',
            'target_days.required' => 'The Target Days is required.',
            'date_of_birth.required' => 'The Date of Birth is required.'
        ];
    }
}
