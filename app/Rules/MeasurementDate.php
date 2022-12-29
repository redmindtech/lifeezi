<?php

namespace App\Rules;

use App\Models\Measurement;
use Illuminate\Contracts\Validation\Rule;

class MeasurementDate implements Rule
{
       public $message,$client_id;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($client_id)
    {
        $this->client_id = $client_id;
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
            $measurement = Measurement::where('client_id',$this->client_id)->where('date', $value)->get();
            if(count($measurement) > 0){
                $this->message = 'The measurement date is already register.Please choose the another date.';
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
