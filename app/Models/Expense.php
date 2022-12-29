<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Expense extends Model
{
    use HasFactory;
    const REQUEST_INPUTS = ['expenses_date','amount','expenses_type','paid_to','comments'];

    protected $table = 'expenses';

    protected $fillable = ['expenses_date','amount','expenses_type','paid_to','comments'];
}
