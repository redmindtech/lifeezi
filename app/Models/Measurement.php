<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Measurement extends Model
{
    use HasFactory,SoftDeletes;

    const REQUEST_INPUTS = ['client_id','onboarding_id','measurement_date', 'next_measurement_date', 'comments','measurement_types','values','measurement_comments'];

    protected $table = 'measurements';

    protected $fillable = ['client_id','onboarding_id','measurement_date', 'next_measurement_date', 'comments','measurement_types','values','measurement_comments'];

    public function measurement_type() {
        return $this->hasMany(MeasurementType::class);
    }

    
    public function measurement_client() {
        return $this->belongsTo(Client::class);
    }

    
    public function measurement_onboarding() {
        return $this->belongsTo(Onboarding::class);
    }
}
