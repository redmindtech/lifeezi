<?php

namespace App\Http\Requests;

use App\Rules\PlanningEndDate;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\PlanningDate;

class PlanningRequest extends FormRequest
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
            'plan_start_date' => new PlanningDate(request('client_id'),request('plan_end_date')),
            'plan_end_date' => new PlanningEndDate(request('client_id'),request('plan_start_date')),
        ];
    }
}
