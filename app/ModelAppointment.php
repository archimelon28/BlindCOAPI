<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelAppointment extends Model
{
    protected $table = 'appointments';
    protected $primaryKey = 'id_appoint';
    protected $dates = ['tanggal_janji'];
    protected $fillable = [
    	'id_pasien','id_doctor','tanggal_janji','keterangan'
    ];
}
