<?php

namespace App\Rules;

use App\Models\Planning;
use Illuminate\Contracts\Validation\Rule;

class PlanningDate implements Rule
{
    public $message, $end_date,$client_id;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($client_id = null,$end_date = null)
    {
        $this->client_id = $client_id;
        $this->end_date = $end_date;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
         if (!$value) {
            $this->message = 'Please enter a valid date';
            return false;
        }
        if($value){
            $plan_start_date = Planning::where('client_id', $this->client_id)->when($value,function ($query, $value) {
                $query->where('plan_start_date', '>=', $value);
                $query->where('plan_start_date', '<=', $this->end_date);
            })->when($value,function ($query, $value) {
                $query->orWhere('plan_end_date', '>=', $value);
                $query->where('plan_end_date', '<=', $this->end_date);
            })->get();
            if(count($plan_start_date) > 0){
                $this->message = 'The plan start date is already register.Please choose the another date.';
                return false;
            }
            return true;
        }
        return true;
        
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->message;
    }
}
