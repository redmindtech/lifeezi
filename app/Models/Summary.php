<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Summary extends Model
{
    use HasFactory,SoftDeletes;

        protected $table = 'summaries';

    protected $fillable = [ 
        'client_id',
        'summary_date',
        'summary_details',
        'summary_status'
    ];

    const REQUEST_INPUTS =  [
      'client_id',
        'summary_date',
        'summary_details',
        'summary_status'
    ];

    public function client_summary(){
        return $this->belongsTo(Client::class);
    }
}
