<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
	/**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'pro_id';
	
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pro_name', 'pro_description', 'pro_dt_start', 'pro_dt_end'
    ];
}
