<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientPayment extends Model
{
    use HasFactory,SoftDeletes;

    const REQUEST_INPUTS = ['client_id', 'payment_date', 'payment_status'];

    protected $fillable = ['client_id', 'payment_date', 'payment_status',"next_payment_date"];

    public function client(){
        return $this->belongsTo(Client::class);
    }
}
