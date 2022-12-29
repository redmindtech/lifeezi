<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ScheduleAssement extends Model
{
     use HasFactory,SoftDeletes;

    protected $table = 'schedule_assements';

    protected $fillable = [ 
        'client_id',
        'schedule_date_time',
        'comments',
    ];

    const REQUEST_INPUTS =  [
        'client_id',
        'schedule_date_time',
        'comments',
    ];

    public function client_schedule_assement(){
        return $this->belongsTo(Client::class);
    }
}
