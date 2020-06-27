<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor', function (Blueprint $table) {
            $table->increments('id_doctor');
            $table->string('nama',50);
            $table->text('alamat');
            $table->enum('jenis_kelamin',['L','P']);
            $table->date('tanggal_lahir');
            $table->string('foto',255);
            $table->string('email',50);
            $table->string('password',255);
            $table->timestamps();
        });

        Schema::table('appointments',function(Blueprint $table)
            {
                $table->foreign('id_doctor')->references('id_doctor')
                ->on('doctor');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctor');
    }
}
