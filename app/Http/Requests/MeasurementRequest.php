<?php

namespace App\Http\Requests;

use App\Rules\MeasurementDate;
use Illuminate\Foundation\Http\FormRequest;

class MeasurementRequest extends FormRequest
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
            'measurement_date' => new MeasurementDate(request('client_id')),
        ];
    }

    public function messages()
    {
        return [
                'measurement_date.required' => 'The Measurement Date is required.',
                'next_measurement_date.required' => 'The Next Measurement Date is required.'
            ];
    }
}
