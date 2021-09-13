<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class VaccinesSchedules extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * création de la table intermédiare vaccines_schedules_vaccines qui lie les tables vaccines et vacinne_schedules
     */
    public function up()
    {
        Schema::create('vaccines_schedules_vaccines', function (Blueprint $table) {
            $table->id();
            $table->integer("vaccine_id");
            $table->integer('vaccine_schedule_id');
           
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
