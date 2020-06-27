<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\ModelPasien;
use App\ModelDoctor;
use DB;
use Hash;
use Session;
use App\ModelAppointment;
use Carbon\Carbon;
class ControllerPasien extends Controller
{
  public function index()
  {
    return view('index');
  }

  public function registerPasien(Request $request){
    
    if($request->roles == 1){
      $data =  new ModelPasien();
      $data->nama_pasien = $request->nama_pasien;
      $data->alamat = $request->alamat;
      $data->jenis_kelamin = $request->jenis_kelamin;
      $data->tanggal_lahir = $request->tanggal_lahir;
      $foto = $request->file('foto');
      $ext = $foto->getClientOriginalExtension();
      $newName = "foto".date('Ymd_his').".".$ext;
      $foto->move('assets/images',$newName);
      $data->foto = $newName;
      $data->email = $request->email;
      $data->password = bcrypt($request->password);

      $this->validate($request,[
          'nama_pasien' => 'required|string|size:4',
          'alamat' => 'required',
          'jenis_kelamin' => 'required|in:L,P',
          'tanggal_lahir' => 'required|date_format:Y-m-d|before:today',
          'email' => 'required|unique:pasien,email',
          'password' => 'required'
      ]);


      
      $data->save();

      return redirect('/');
    
    }elseif($request->roles == 2)
      {
        $data =  new ModelDoctor();
        $data->nama = $request->nama_pasien;
        $data->alamat = $request->alamat;
        $data->jenis_kelamin = $request->jenis_kelamin;
        $data->tanggal_lahir = $request->tanggal_lahir;
        $foto = $request->file('foto');
        $ext = $foto->getClientOriginalExtension();
        $newName = "foto".date('Ymd_his').".".$ext;
        $foto->move('assets/images',$newName);
        $data->foto = $newName;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);

        $this->validate($request,[
            'nama_pasien' => 'required|string|size:4',
            'alamat' => 'required',
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'required|date_format:Y-m-d|before:today',
            'email' => 'required|unique:pasien,email',
            'password' => 'required'
        ]);


        $data->save();

        return redirect('/');
      }
      else{
        return redirect('/');
      }
  }

  public function loginPost(Request $request)
  {
    $roles = $request->roles;
    $email = $request->email;
    $password = $request->password;


    if ($roles == 1) {
      $data = DB::table('pasien')->where('email',$email)->first();
      if($data){ //apakah email tersebut ada atau tidak
          if(Hash::check($password, $data->password)) {
              Session::put('nama_pasien',$data->nama_pasien);
              Session::put('roles',$request->roles);
              Session::put('idp',$data->id_pasien);
              Session::put('login',TRUE);
              return redirect('/');
          }
          else{
              return redirect('/')->with('alert','Password Salah !');
          }
      }
    else{
        return redirect('/')->with('alert','Password atau Email, Salah!');
    }
    } elseif ($roles == 2) {
        $data = DB::table('doctor')->where('email',$email)->first();
        if($data){ //apakah email tersebut ada atau tidak
            if(Hash::check($password, $data->password)) {
                Session::put('nama_doctor',$data->nama);
                Session::put('roles',$request->roles);
                Session::put('idd',$data->id_doctor);
                Session::put('login',TRUE);
                return redirect('/');
            }
            else{
                return redirect('/')->with('alert','Password Salah !');
            }
        }
      else{
          return redirect('/')->with('alert','Password atau Email, Salah!');
      }
    }
  }
  public function logout(){
    Session::flush();
    return redirect('/')->with('alert-success','Kamu sudah logout');
  }

  public function profil($id)
  {
    if (Session::get('idp') != null)
    {
      $data = ModelPasien::where('id_pasien',Session::get('idp'))->first();
      // dd($data->tanggal_lahir);die();
      return view('profil',compact('data'));
      
    } elseif (Session::get('idd') != null)
    {
      $data = ModelDoctor::where('id_doctor',Session::get('idd'))->first();
      return view('profil',compact('data'));
    }
  }

  public function updateProfil(Request $request)
  {
      if (Session::get('idp') != null)
      {
      $data =  ModelPasien::findorFail(Session::get('idp'));
      // dd($data);die();
      $data->nama_pasien = $request->nama_pasien;
      $data->alamat = $request->alamat;
      $data->jenis_kelamin = $request->jenis_kelamin;
      $data->tanggal_lahir = $request->tanggal_lahir;
      if (empty($request->file('foto'))){
            $data->foto = $data->foto;
        }
      else{
        unlink('assets/images'.$data->foto); //menghapus file lama
          $foto = $request->file('foto');
          $ext = $foto->getClientOriginalExtension();
          $newName = "foto".date('Ymd_his').".".$ext;
          $foto->move('assets/images',$newName);
          $data->foto = $newName;
      }
      $data->email = $request->email;
      
      // $this->validate($request,[
      //     'nama_pasien' => 'required|string|size:4',
      //     'alamat' => 'required',
      //     'jenis_kelamin' => 'required|in:L,P',
      //     'tanggal_lahir' => 'required|date_format:Y-m-d|before:today',
      //     'email' => 'required|unique:pasien,email',
      //     'password' => 'required'
      // ]);


      
      $data->save();

      return redirect('/');
      } elseif (Session::get('idd') != null){
        $data =  ModelDoctor::where('id_doctor',Session::get('idd'));
        $data->nama = $request->nama_pasien;
        $data->alamat = $request->alamat;
        $data->jenis_kelamin = $request->jenis_kelamin;
        $data->tanggal_lahir = $request->tanggal_lahir;
        $foto = $request->file('foto');
        $ext = $foto->getClientOriginalExtension();
        $newName = "foto".date('Ymd_his').".".$ext;
        $foto->move('assets/images',$newName);
        $data->foto = $newName;
        $data->email = $request->email;
      
        $this->validate($request,[
            'nama_pasien' => 'required|string|size:4',
            'alamat' => 'required',
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'required|date_format:Y-m-d|before:today',
            'email' => 'required|unique:pasien,email',
            'password' => 'required'
        ]);


        $data->save();

        return redirect('/');
      }
      
  }

  public function appointmentStore()
  {
    $doctor = ModelDoctor::select('id_doctor','nama')->get();
    return view('appointment',compact('doctor'));
  }

  public function appointmentEdit($id_appoint)
  {
    $doctor = ModelDoctor::select('id_doctor','nama')->get();
    $appointment = ModelAppointment::where('id_appoint',$id_appoint)
                    ->join('pasien','pasien.id_pasien','=','appointments.id_pasien')
                    ->join('doctor','doctor.id_doctor','=','appointments.id_doctor')
                     ->first();
    // dd($appointment);die();
    return view('appointmentEdit',compact('doctor','appointment'));
  }

  public function appointment()
  {
    if (Session::get('idp') != null) {
      $date = Carbon::now();
      $data1 =  $date->toDateString();
      $appointment = ModelAppointment::where('appointments.id_pasien', Session::get('idp'))
                      ->where('tanggal_janji','>',$data1)
                      ->join('pasien','pasien.id_pasien','=','appointments.id_pasien')
                      ->join('doctor','doctor.id_doctor','=','appointments.id_doctor')
                      ->get();
      return view('appointmentBase',compact('appointment'));  
    }
    elseif (Session::get('idd') != null) {
      $date = Carbon::now();
      $data1 =  $date->toDateString();
      $appointment = ModelAppointment::where('appointments.id_pasien', Session::get('idd'))
                      ->where('tanggal_janji','>',$data1)
                      ->join('pasien','pasien.id_pasien','=','appointments.id_pasien')
                      ->join('doctor','doctor.id_doctor','=','appointments.id_doctor')
                      ->get();
      return view('appointmentBase',compact('appointment'));  
    }
    
  }

  public function appointmentPost(Request $request)
  {
        $appointment = new ModelAppointment();
        $appointment->id_pasien = Session::get('idp');
        $appointment->id_doctor = $request->id_doctor;
        $appointment->tanggal_janji = $request->tanggal_janji;
        $appointment->keterangan = $request->keterangan;
        $appointment->save();        
        
        return redirect('/appointment')->with('alert-success', 'Yeah Selamat!! Anda berhasil menambahkan data!');
  }

  public function appointmentUpdate(Request $request,$id_appoint)
  {
    $appointment =  ModelAppointment::findorFail($id_appoint);
    $appointment->id_pasien = Session::get('idp');
    $appointment->id_doctor = $request->id_doctor;
    $appointment->tanggal_janji = $request->tanggal_janji;
    $appointment->keterangan = $request->keterangan;
    $appointment->save();        
    // Route::get('appointment/{id}','ControllerPasien@appointment')->name('appointment');
    return redirect('/appointment/'.Session::get('idp'))->with('alert-success', 'Yeah Selamat!! Anda berhasil menambahkan data!');
  }
}