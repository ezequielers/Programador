<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
	/**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'emp_id';
	
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'emp_name'
    ];
}
