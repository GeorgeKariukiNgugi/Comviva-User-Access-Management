<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_employees', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->bigIncrements('id');
            
            $table->bigInteger('companyId')->unsigned();
            
            // ! Implementing the relationship between the employee and the Company. 
            $table->foreign('companyId')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');

            $table->bigInteger('usersId')->unsigned();

            $table->foreign('usersId')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

            $table->string('employeeName');            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_employees');
    }
}
