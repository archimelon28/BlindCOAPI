@extends('base')
@section('content')
    @include('navbar')
    <section class="ftco-section contact-section ftco-degree-bg">
        <div class="container">
          <div class="row block-9">
            <div class="col-md-12">
              @if(\Session::has('alert'))
                <div class="alert alert-danger">
                    <div>{{Session::get('alert')}}</div>
                </div>
              @endif
              @if (Session::get('idp') != null)
              <form action="{{ url('profilUpdate', Session::get('idp')) }}" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Your Name" name="nama_pasien" value="{{$data->nama_pasien}} ">
                </div>
              @elseif (Session::get('idd') != null)
              <form action="{{ url('profilUpdate', Session::get('idd')) }}" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="form-group">
                  <input type="text" class="form-control" placeholder="Your Name" name="nama" value="{{$data->nama}} ">
                </div>
                @endif
                <div class="form-group">
                <textarea cols="30" rows="7" class="form-control" placeholder="alamat" name="alamat">{{$data->alamat}} </textarea>
                </div> 
                <div class="form-group">
                    @if ($data->jenis_kelamin == 'L') 
                    <input type="radio" name="jenis_kelamin" value="L" checked>Laki-laki
                    <input type="radio" name="jenis_kelamin" value="P" >Perempuan
                    @elseif ($data->jenis_kelamin == 'P')
                    <input type="radio" name="jenis_kelamin" value="L" >Laki-laki
                    <input type="radio" name="jenis_kelamin" value="P" checked>Perempuan
                    @endif
                </div> 
                <div class="form-group">
                    <input type="date"  class="form-control" name="tanggal_lahir" value="{{ $data->tanggal_lahir->format('Y-m-d') }}" placeholder="Tanggal Lahir">
                  </div>
                  <div class="form-group">
                    <img src="{{asset('assets/images').'/'.$data->foto}}" alt="" width="350px">
                    <input type="file" class="form-control" name="foto">
                  </div>
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Email" name="email" value="{{$data->email}} ">
                </div>
                <div class="form-group">
                  <input type="submit" style="float: right;" value="Update data" class="btn btn-primary py-3 px-5">
                </div>
              </form>
            
            </div>
  
          </div>
        </div>
      </section>
@endsection