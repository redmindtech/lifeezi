<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ObservationDate;

class ObservationRequest extends FormRequest
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
        if(request())
        
        return [
            'date' => new ObservationDate(request('client_id')),
            'day_of_observation' => 'required',
        ];
    }

    public function messages()
    {
        return [
                'day_of_observation.required' => 'The Day of Observation is required.'
            ];
    }
}
