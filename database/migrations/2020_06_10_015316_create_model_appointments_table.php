<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->increments('id_appoint');
            $table->integer('id_pasien')->unsigned();
            $table->integer('id_doctor')->unsigned();
            $table->date('tanggal_janji');
            $table->time('jam_janji',0);
            $table->text('keterangan');
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
        Schema::dropIfExists('appointments');

        Schema::create('pasien', function (Blueprint $table) {
            $table->dropForeign('appointments_id_pasien_foreign');

        });

         Schema::create('doctor', function (Blueprint $table) {
            $table->dropForeign('appointments_id_doctor_foreign');

        });
         
    }
}
