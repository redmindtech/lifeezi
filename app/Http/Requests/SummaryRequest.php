<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SummaryRequest extends FormRequest
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
            'summary_date' => 'required|string',
            'summary_details' => 'required|string',
            'summary_status'=> 'required|string'
        ];
    }

    public function messages()
    {
        return [
                'summary_date.required' => 'The Assessment Date is required.',
                'summary_details.required' => 'The Assessment Details is required.',
                'summary_status.required' => 'The Assessment Status is required.'
            ];
    }
}
