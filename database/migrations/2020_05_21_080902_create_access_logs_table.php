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
            $table->bigIncrements('id');
            $table->bigInteger('visitorId');

            // ! Added the relationship between the log table and the visitor table.
            $table->foreign('visitorId')->references('id')->on('visitor');

            $table->bigInteger('companyId');

            // ! Added the relationship between the log table and the company table.
            $table->foreign('companyId')->references('id')->on('companies');

            $table->bigInteger('typeOfVisitorId');
            
            // ! Added the relationship between the log table and the typeOfVisitors table.
            $table->foreign('typeOfVisitorId')->references('id')->on('visitor_types');

            $table->dateTime('timeIn');
            $table->dateTime('TimeOut')->nullable();
            $table->bigInteger('approvedById');

            // ! Added the relationship between the log table and the users table.
            $table->foreign('approvedById')->references('id')->on('users');

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
