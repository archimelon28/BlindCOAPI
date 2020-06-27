@extends('base')
@section('content')
@include('navbar')
@if (Session::get('idd') == null)
<br>
<a href="{{url('appointmentStore')}} " style="float: right;">
  <button type="button" class="btn btn-primary btn-fw">Tambah Data</button>
</a>
<br>
@endif
<br>
<div class="table-responsive">
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>
          No.
        </th>
        <th>
          Nama Pasien
        </th>
        <th>
          Nama Dokter
        </th>
        <th>
          Tanggal Janji
        </th>
        <th>
          Keterangan
        </th>
        @if (Session::get('idd') == null)
        <th>
          Aksi
        </th>
        @endif
    </thead>
      <tbody>
        @php $no = 1 @endphp
        @foreach($appointment as $p)
        <tr>
          <td>
            {{$no++}}
          </td>
          <td>{{$p->nama_pasien}}</td>
          <td>{{$p->nama}}</td>
          <td>{{$p->tanggal_janji}}</td>
          <td>{{$p->keterangan}}</td>
          @if(Session::get('idp') !=  null)
          <td>
            <form method="POST">
                @csrf
                {{ method_field('DELETE') }}
            <a  class="btn btn-sm btn-primary" href="{{ url('appointmentEdit', $p->id_appoint ) }}" title="">
            Edit</a>
            </form>
          </td>
        @endif
        </tr>
        @endforeach
      </tbody>
  </table>
</div>
@endsection