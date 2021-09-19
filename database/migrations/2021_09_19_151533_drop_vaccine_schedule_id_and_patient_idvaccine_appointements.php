<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropeVaccineScheduleIdAndPatientIdVaccineAppointements extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vaccine_appointements', function (Blueprint $table) {
            $table->dropColumn(['vaccine_schedule_id', 'patient_id']);
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
