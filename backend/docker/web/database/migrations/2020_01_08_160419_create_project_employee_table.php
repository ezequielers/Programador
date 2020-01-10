<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_employee', function (Blueprint $table) {
            $table->bigIncrements('pem_id');
            $table->unsignedBigInteger('pem_project_id');
            $table->unsignedBigInteger('pem_employee_id');
            $table->tinyInteger('pem_manager')->unsigned();
			$table->timestamps();
			
			$table->foreign('pem_project_id')->references('pro_id')->on('projects');
            $table->foreign('pem_employee_id')->references('emp_id')->on('employees');  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_employee');
    }
}
