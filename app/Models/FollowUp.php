<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FollowUp extends Model
{
    use HasFactory,SoftDeletes;

    const REQUEST_INPUTS = [
        'client_id',
        'follow_date',
        'follow_day',
        'follow_up',
        'comments',
        'deviation',
        'weight'
    ];

    protected $fillable = [
        'client_id',
        'follow_date',
        'follow_day',
        'follow_up',
        'comments',
        'deviation',
        'weight'
    ];

    protected $table = 'follow_ups';


    public function client(){
        return $this->belongsTo(Client::class);
    }
}
