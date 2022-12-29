<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UploadLab extends Model
{
    use HasFactory,SoftDeletes;

    const REQUEST_INPUTS = [
                'client_id',
        'test_date',
        'report_stage',
        'upload_lab',
        'next_test_date'
        ];

    protected $table = 'upload_labs';

    protected $fillable = [
        'client_id',
        'test_date',
        'report_stage',
        'upload_lab',
        'next_test_date'
    ];

    public function upload_lab_type() {
        return $this->hasMany(UploadLabType::class);
    }

    public function client(){
        return $this->belongsTo(Client::class);
    }
}
