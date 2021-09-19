<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVaccineScheduleIdAndPatientIdToVaccineAppointements extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vaccine_appointements', function (Blueprint $table) {
            $table->integer("vaccine_schedule_id")->nullable();
            $table->integer("patient_id")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vaccine_appointements', function (Blueprint $table) {
            //
        });
    }
}
