<?php

namespace App\Http\Requests;

use App\Rules\UploadLabDate;
use App\Rules\UploadNextDate;
use Illuminate\Foundation\Http\FormRequest;

class UploadRequest extends FormRequest
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
            'test_date' => new UploadLabDate(request('client_id'),request('next_test_date')),
            'next_test_date' => new UploadNextDate(request('client_id')),
        ];
    }

    public function messages()
    {
        return [
                'test_date.required' => 'The Test date is required.',
                'next_test_date.required' => 'The Next Test Date is required.'
            ];
    }
}
