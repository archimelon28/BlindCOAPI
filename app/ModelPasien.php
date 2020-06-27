<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelPasien extends Model
{
    protected $table = 'pasien';
    protected $primaryKey = 'id_pasien';
    protected $dates = ['tanggal_lahir'];
    protected $fillable = [
    	'nama_pasien','alamat','jenis_kelamin','tanggal_lahir','email','password'
    ];

    public function pasien()
    {
    	return $this->hasMany('App\ModelPasien','id_pasien');
    }
}
