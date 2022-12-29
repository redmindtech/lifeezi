<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Observation extends Model
{
    use HasFactory,SoftDeletes;


    const REQUEST_OBSERVATION = [
                    'client_id',
            'onboarding_id',
            'date',
            'day_of_observation',
            'wake_up_time',
            'bed_time',
            'exercise_routine',
            'steps',
            'water_intake'
        ];

    protected $table = 'observations';

    protected $fillable = [
        'client_id',
        'onboarding_id',
        'date',
        'day_of_observation',
        'wake_up_time',
        'bed_time',
        'exercise_routine',
        'steps',
        'water_intake'
    ];


    public function observation_type() {
        return $this->hasMany(ObservationType::class);
    }
      public function client() {
        return $this->belongsTo(Client::class);
    }

    public function observation_onboarding() {
        return $this->belongsTo(Onboarding::class);
    }
}
