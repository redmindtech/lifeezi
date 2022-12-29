<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ObservationType extends Model
{
    use HasFactory,SoftDeletes;

    const REQUEST_INPUTS = [
        'observation_id',
        'meal_type',
        'meal_time',
        'meal',
        'comments'
    ];

    protected $table = 'observation_types';

    protected $fillable = [
        'observation_id',
        'meal_type',
        'meal_time',
        'meal',
        'comments'
    ];

    public function observation() {
        return $this->belongsTo(Observation::class);
    }
}
