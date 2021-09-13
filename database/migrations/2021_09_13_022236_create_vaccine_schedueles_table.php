<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVaccineScheduelesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vaccine_schedueles', function (Blueprint $table) {
            $table->id();
            $table->date("schedule_date");
            $table->char('start_time', 5);
            $table->char('end_time', 5);
            $table->integer('status'); // 0 ou 1 pour indiquer si l'emploi de temps est activé ou non
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
        Schema::dropIfExists('vaccine_schedueles');
    }
}
