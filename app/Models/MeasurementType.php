<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MeasurementType extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'measurement_types';

    protected $fillable = ['measurement_id', 'measurement_type', 'value', 'comments'];

    public function measurement() {
        return $this->belongsTo(Measurement::class);
    }

}
