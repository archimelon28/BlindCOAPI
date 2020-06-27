@extends('base')
@section('content')
    @include('navbar')
    <section class="ftco-section contact-section ftco-degree-bg">
        <div class="container">
          <div class="row block-9">
            <div class="col-md-12">
              <form action="{{ url('/appointmentPost') }}" enctype="multipart/form-data" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <div class="form-line">
                        <select class="form-control show-tick" name="id_doctor" data-live-search="true">
                        @foreach($doctor as $d)
                        <option value="{{$d->id_doctor}}">{{$d->nama}}</option>
                        @endforeach
                    </select>
                    </div>
                </div> 
                <div class="form-group">
                    <input type="date"  class="form-control" name="tanggal_janji" placeholder="Tanggal janji">
                  </div>
                <div class="form-group">
                    <textarea cols="30" rows="7" class="form-control" placeholder="Keterangan" name="keterangan"></textarea>
                </div>
               <div class="form-group">
                  <input type="submit" style="float: right;" value="Send" class="btn btn-primary py-3 px-5">
                </div>
              </form>
            
            </div>
  
          </div>
        </div>
      </section>
@endsection