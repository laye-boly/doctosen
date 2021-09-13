<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVaccineAppointementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vaccine_appointements', function (Blueprint $table) {
            $table->id();
            $table->date("appointement_date");
            $table->time("appointement_hour");
            $table->integer("vaccine_schedule_id");
            $table->integer("patient_id");
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
        Schema::dropIfExists('vaccine_appointements');
    }
}
