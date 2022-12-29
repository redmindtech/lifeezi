<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Disengagement extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'disengagements';

    protected $fillable = [
        'client_id',
        'disengagement_type',
        'date',
        'disengagement_reason',
        'comments',
        'reviewed_by',
        'download'
    ];

    const REQUEST_INPUTS = [
        'client_id',
        'disengagement_type',
        'date',
        'disengagement_reason',
        'comments',
        'reviewed_by'
    ];

    public function client() {
        return $this->belongsTo(Client::class);
    }
}
