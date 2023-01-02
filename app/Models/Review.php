<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use HasFactory,SoftDeletes;
    
     

    const REQUEST_INPUTS = [
        'client_id',
        'review_date',
        'next_review_date',
        'client_progress',
        'client_concern',
        'area_need_to_focus'
    ];
    
    protected $table = 'reviews';

    protected $fillable =  [
        'client_id',
        'review_date',
        'next_review_date',
        'client_progress',
        'client_concern',
        'area_need_to_focus'
    ];

   
    public function client(){
        return $this->belongsTo(Client::class);
    }
}