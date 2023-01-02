<?php

namespace App\Http\Requests;

use App\Rules\ReviewDate;
use App\Rules\ReviewNextDate;
use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
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
            'review_date' => new ReviewDate(request('client_id'),request('next_review_date')),
            'next_review_date' => 'required',
        ];
    }
}