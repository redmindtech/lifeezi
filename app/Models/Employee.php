<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory,SoftDeletes;

    const REQUEST_INPUTS = ['employee_name', 'designation', 'date_of_joining', 'email', 'salary', 'status'];

    protected $table = 'employees';

    protected $fillable = ['employee_name', 'designation', 'date_of_joining', 'email', 'salary', 'status'];
}
