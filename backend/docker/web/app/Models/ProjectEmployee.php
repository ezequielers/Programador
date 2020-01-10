<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectEmployee extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'project_employee';

	/**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'pem_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pem_project_id', 'pem_employee_id', 'pem_manager'
    ];
}
