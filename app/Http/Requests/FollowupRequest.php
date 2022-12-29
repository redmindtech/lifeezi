<?php

namespace App\Http\Requests;

use App\Rules\FollowUpDate;
use Illuminate\Foundation\Http\FormRequest;

class FollowupRequest extends FormRequest
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
            'follow_date' => new FollowUpDate(request('client_id')),
            'follow_day' => 'required',
            'follow_up' =>'required',
        ];
    }

    public function messages()
    {
        return [
            'follow_date.required' => 'The date is required.',
            'follow_day.required' => 'The day is required.',
            'follow_up.required' => 'The follow up is required'
        ];
    }
}
