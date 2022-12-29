<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Planning extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'plannings';

    protected $fillable = [
        'client_id',
        'plan_start_date',
        'plan_end_date',
        'mail_send_date',
        'explanation_date',
        'objective',
        'wake_up_time',
        'bed_time',
        'steps',
        'water_intake',
        'food_to_avoid',
        'comments',
        'exercise_routine'
    ];

    const REQUEST_INPUTS = [
        'client_id',
        'plan_start_date',
        'plan_end_date',
        'mail_send_date',
        'explanation_date',
        'objective',
        'wake_up_time',
        'bed_time',
        'steps',
        'water_intake',
        'food_to_avoid',
        'comments',
        'exercise_routine'
        ];

        public function plan_types() {
        return $this->hasMany(PlanType::class);
        }

        public function client() {
        return $this->belongsTo(Client::class);
        }
}
