<?php

namespace App\Rules;

use App\Models\Planning;
use Illuminate\Contracts\Validation\Rule;

class PlanningEndDate implements Rule
{
    public $message, $start_date,$client_id;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($client_id = null,$start_date)
    {
        $this->client_id = $client_id;
        $this->start_date = $start_date;
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
                $query->where('plan_start_date', '>=', $this->start_date);
                $query->where('plan_start_date', '<=', $value);
            })->when($value,function ($query, $value) {
                $query->orWhere('plan_end_date', '>=', $this->start_date);
                $query->where('plan_end_date', '<=', $value);
            })->get();
            if(count($plan_start_date) > 0){
                $this->message = 'The plan end date is already register.Please choose the another date.';
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
