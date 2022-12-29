<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Onboarding extends Model
{
    use HasFactory,SoftDeletes;

        const REQUEST_INPUTS = ['client_id', 'onboarding_date', 'target_days', 'date_of_birth', 'occupation', 'address', 'height','weight','client_fee','upload_form','coach', 'past_history','comments','family_disease_history','current_medication','objective_client'];

        protected $fillable = ['client_id', 'onboarding_date', 'target_days', 'date_of_birth', 'occupation', 'address', 'height','weight','client_fee','upload_form','coach', 'past_history','comments','family_disease_history','current_medication','objective_client'];

    protected $table = 'onboardings';

    public function client() {
        return $this->belongsTo(Client::class);
    }

    public function onboarding_measurement() {
        return $this->hasMany(Measurement::class);
    }
    
}
