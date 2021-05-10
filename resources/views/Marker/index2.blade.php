@extends('layouts.template')
@section('title')
  Maker
@endsection
@section('header')

@endsection
@section('content')
  <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              @include('alert.error')
              <div class="box-header with-border">
              @include('alert.error')
              <a class="btn btn-success" href="{{ route('marker.create') }}"><span class="glyphicon glyphicon-plus"></span> Create </a>
              <a class="btn btn-primary" href="{{ url('kordinat_marker') }}"><span class="glyphicon glyphicon-globe"></span> Marker </a>
              <a class="btn btn-info" href="{{ url('export_marker') }}">
                 Export File</a>
              <button type="button" class="btn btn-primary mr-5" data-toggle="modal" data-target="#importExcel">
                IMPORT EXCEL
              </button>

            </div>
            </div>
            <div class="box-body">
              @include('alert.succes')
              <table class="table dataTable" id="datatable">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Id Pel</th>
                    <th>Nama Jalan</th>
                    <th>Status Lampu</th>
                    <th>Lat</th>
                    <th>Long</th>
                    <th>No Travo</th>
                    <th>Jaringan</th>
                    <th>Tiang</th>
                    <th>Kategori</th>
                    <th>Daya</th>
                    <th>Rayon</th>
                    <th>Rt/Rw</th>
                    <th>KEL</th>
                    <th>KEC</th>
                    <th>Ket</th>
                    <th >Aksi</th>
                  </tr>
                  <tbody>

                  </tbody>
                </thead>
              </table>
            </div>
          </div>
        </div>
</div>
{{-- modal import xls --}}
<div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <form method="post" action="{{ url('import_marker')}}" enctype="multipart/form-data">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
            </div>
            <div class="modal-body">

              {{ csrf_field() }}

              <label>Pilih file excel</label>
              <div class="form-group">
                <input type="file" name="file" required="required">
              </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Import</button>
            </div>
          </div>
        </form>
      </div>
    </div>

@endsection
@section('footer')
  <script type="text/javascript">
    $(function(){

      $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
       });

      $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          url : "{{ route('marker.index')}}"
        },
        columns: [
          {data: 'DT_RowIndex', name: 'DT_RowIndex'},
          { data: 'id_pel', name: 'id_pel' },
          { data: 'nama_jalan', name: 'nama_jalan' },
          { data: 'st_panel', name: 'st_panel' },
          { data: 'lat', name: 'lat' },
          { data: 'long', name: 'long'},
          { data: 'no_travo', name: 'no_travo' },
          { data: 'jaringan', name: 'jaringan' },
          { data: 'tiang', name: 'tiang' },
          { data: 'kategori', name: ' kategori' },
          { data: 'daya', name: 'daya' },
          { data: 'rayon', name: 'rayon'},
          { data: 'rt_rw', name: 'rt_rw' },
          { data: 'kel', name: 'kel' },
          { data: 'kec', name: 'kec' },
          { data: 'ket', name: 'ket' },
          { data: 'action', name: 'action',orderable: false, searchable: false },
        ],
        order: [[0, 'ASC']]
      });
    });
  </script>
@endsection
