<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory,SoftDeletes;

    const REQUEST_INPUTS = ['client_name', 'sex', 'mobile', 'landline', 'email', 'transformation_plan','reference','reference_input','expiry_date','journey','comments','status'];

    protected $fillable = ['client_name', 'sex', 'mobile', 'landline', 'email', 'transformation_plan','transformation_input','reference_input','reference','expiry_date','journey','comments','status'];

    protected $table = 'clients';

    public function onboarding() {
        return $this->hasOne(Onboarding::class);
    }

    public function observation() {
        return $this->hasMany(Observation::class);
    }

    public function measurement() {
        return $this->hasMany(Measurement::class);
    }

    public function disengagement() {
        return $this->hasOne(Disengagement::class);
    }

    public function schedule_assement() {
        return $this->hasOne(ScheduleAssement::class);
    }

    public function summary() {
        return $this->hasOne(Summary::class);
    }

    public function upload_lab(){
        return $this->hasMany(UploadLab::class);
    }

    public function planning() {
        return $this->hasMany(Planning::class);
    }

    public function follow_up(){
        return $this->hasMany(FollowUp::class);
    }

    public function client_payment() {
        return $this->hasOne(ClientPayment::class);
    }

    public function reviews(){
        return $this->hasMany(Review::class);
    }
}