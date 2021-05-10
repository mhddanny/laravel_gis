@extends('layouts.template')
@section('title')
  Maker
@endsection
@section('header')

    <meta name="@csrf" content="{{ csrf_token() }}">

   {{-- csss leaflet google map  --}}
    <link rel="stylesheet" href="{{ asset('leaflet/leaflet.css')}}">
    {{-- css datatable --}}
    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>


@endsection
@section('content')
  <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              @include('alert.error')
            </div>
            <div class="box-body">
              @include('alert.succes')
              <table class="table table-bordered" id="datatable">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Panel</th>
                    <th>Travo</th>
                    <th>Jumlah Lampu</th>
                    <th>Jaringan</th>
                    <th>Tiang</th>
                  </tr>
                  <tbody>
                    @foreach ($panel as $row)
                      <tr>
                      <td></td>
                      <td>{{ $row->no_panel }}</td>
                      <td>{{ $row->travo->nama_travo }}</td>
                        <td></td>
                        <td>{{ $row->lampu->jaringan->nama_jaringan}}</td>
                      <td></td>
                      <td></td>
                    </tr>
                    @endforeach
                  </tbody>
                </thead>
              </table>
            </div>
          </div>
        </div>
</div>
@endsection
@section('footer')
  <!--script leaflet google map-->
  <script type="text/javascript" src="{{ asset('leaflet/leaflet.js')}}"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      $('#datatable').DataTable();
    });
  </script>
@endsection
