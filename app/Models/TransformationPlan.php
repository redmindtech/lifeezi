<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransformationPlan extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'transformation_plans';
    protected $fillable = ['name', 'span'];
}
