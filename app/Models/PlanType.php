<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlanType extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'plan_types';

    protected $fillable = [
        'planning_id',
        'meal_category',
        'food_details',
        'meal_time'
    ];

    const REQUEST_INPUTS = [
        'meal_category',
        'food_details',
        'meal_time'
    ];

    public function plannings() {
        return $this->belongsTo(Planning::class);
    }
}
