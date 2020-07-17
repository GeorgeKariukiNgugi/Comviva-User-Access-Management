<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccessLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('access_logs', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->bigIncrements('id');
            $table->bigInteger('visitorId')->unsigned();

            // ! Added the relationship between the log table and the visitor table.
            $table->foreign('visitorId')->references('id')->on('visitors')->onDelete('cascade')->onUpdate('cascade');

            $table->bigInteger('companyId')->unsigned();

            // ! Added the relationship between the log table and the company table.
            $table->foreign('companyId')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');

            $table->bigInteger('typeOfVisitorId')->unsigned();
            
            // ! Added the relationship between the log table and the typeOfVisitors table.
            $table->foreign('typeOfVisitorId')->references('id')->on('visitor_types')->onDelete('cascade')->onUpdate('cascade');

            $table->bigInteger('employeeAttachedToId')->unsigned();

            // ! Adding the relationship between the employee and the companyID. 
            $table->foreign('employeeAttachedToId')->references('id')->on('company_employees')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('approvingManagerApproval')->default(0);
            $table->dateTime('timeIn');
            $table->dateTime('TimeOut')->nullable();
            $table->bigInteger('approvedById')->unsigned();

            // ! Added the relationship between the log table and the users table.
            $table->foreign('approvedById')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

            $table->bigInteger('checkedOutById')->nullable()->unsigned();

            // ! Added the relationship between the log table and the users table.
            $table->foreign('checkedOutById')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('access_logs');
    }
}
