<?php

namespace App\Rules;

use App\Models\Review;
use Illuminate\Contracts\Validation\Rule;

class ReviewDate implements Rule
{
    public $client_id, $message,$next_review_date;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($client_id = null,$next_review_date = null)
    {
        $this->client_id = $client_id;
        $this->next_review_date = $next_review_date;
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
            $follow_up = Review::where('client_id',$this->client_id)->where($attribute, $value)->get();
            if(count($follow_up) > 0){
                $this->message = 'The review date is already register.Please choose the another date.';
                return false;
            }
            if($value == $this->next_review_date){
               $this->message = 'The review date should not same as next review date.Please choose the another date.';
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
