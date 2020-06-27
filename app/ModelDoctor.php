<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelDoctor extends Model
{
    protected $table = 'doctor';
    protected $primaryKey = 'id_doctor';
    protected $dates = ['tanggal_lahir'];
    protected $fillable = [
    	'nama','alamat','jenis_kelamin','tanggal_lahir','email','password'
    ];


    public function doctor()
    {
    	return $this->hasMany('App\ModelDoctor','id_doctor');
    }
}
