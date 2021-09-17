<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MedicalDoctor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_doctor', function (Blueprint $table) {
            
            $table->id();
            $table->integer("doctor_id")->nullable();
            $table->integer("medical_id")->nullable();
            $table->softDeletes();
           
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
        //
    }
}
