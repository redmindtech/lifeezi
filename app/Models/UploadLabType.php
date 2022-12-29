<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UploadLabType extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'upload_lab_types';

    protected $fillable = [
        'upload_lab_id',
        'upload_type',
        'value',
        'comments'
    ];

    const REQUEST_INPUTS = [
        'upload_lab_id',
        'report_type',
        'value',
        'comments'
    ];

    public function upload_lab() {
        return $this->belongsTo(UploadLab::class);
    }
}
