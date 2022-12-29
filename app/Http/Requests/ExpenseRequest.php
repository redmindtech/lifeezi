<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExpenseRequest extends FormRequest
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
            'expenses_date' => 'required|date',
            'amount' => 'required|string',
            'expenses_type' => 'required|string',
            'paid_to' => 'required|string'
            
        ];
    }

    public function messages()
    {
        return [
            'expenses_date.required' => 'The Expense Date is required.',
            'amount.required' => 'The Amount is required.',
            'expenses_type.required' => 'The Expense Type is required.',
            'paid_to.required' => 'The Paid To is required.'
        ];
    }
}
