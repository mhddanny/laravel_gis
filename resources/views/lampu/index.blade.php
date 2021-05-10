@extends('layouts.template')
@section('title')
  Daftar Lampu
@endsection

@section('content')
  <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            @include('alert.error')
              <a class="btn btn-sm btn-success" href="{{ route('lampu.create') }}"><span class="glyphicon glyphicon-plus"></span> Create </a>
              <a class="btn btn-sm btn-primary" href="kordinat_lampu"><span class="glyphicon glyphicon-globe"></span> View </a>
              <a class="btn btn-sm  btn-info" href="{{ route('export_lampu') }}"><span class="glyphicon glyphicon-export"></span>
                 Export Excel</a>
            <button type="button" class="btn btn-sm btn-primary mr-5" data-toggle="modal" data-target="#importExcel"><span class="glyphicon glyphicon-import"></span>
              Import Excel
            </button>

          </div>
          <div class="box-body">

            @include('alert.succes')
                  <table class="table table-bordered" id="datatable">
                    <thead>
                      <tr>
                        <th  width="5%">No</th>
                        <th>Nama lampu</th>
                        <th>Merek Lampu</th>
                        <th>Jenis Lampu</th>
                        <th>No Panel</th>
                        <th>Travo</th>
                        <th>Alamat</th>
                        <th>Tiang</th>
                        <th>Jaringan</th>
                        <th>Lat</th>
                        <th>Long</th>
                        <th>Ket</th>
                        <th>Gambar Travo</th>
                        <th>Action</th>
                      </tr>
                      <tbody>
                        {{-- @foreach ($lampu as $row)
                          <tr>
                            <td>{{ $row->no_lampu }}</td>
                            <td>{{ $row->kategori->nama_lampu}}</td>
                            <td>{{ $row->kategori->kt }}</td>
                            <td>{{ $row->panel->no_panel }}</td>
                            <td>{{ $row->travo->nama_travo }}</td>
                            <td>{{ $row->jalan->nama_jalan }}</td>
                            <td>{{ $row->tiang->nm }}</td>
                            <td>{{ $row->jaringan->nama_jaringan }}</td>
                            <td>{{ $row->ket }}</td>
                            <td class="text-center"><img class="img-thumbnail" src="{{ asset('uploads/'.$row->gambar_lampu) }}" width="50px"></td>
                            <td>
                              <form class="" action="{{ route('lampu.destroy',[$row->kd_lampu]) }}" method="post"
                                onsubmit="return confirm('Apakah Anda Yakin Akan Menghapus Data ini ?')">
                                @csrf
                                {{ method_field('Delete') }}
                                <a class="btn btn-warning" href="{{ route('lampu.edit',[$row->kd_lampu]) }}">Edit</a>
                                <button type="submit" name="button" class="btn btn-danger">Delete</button>
                                <a class="btn btn-info" href="{{ route('lampu.show',[$row->kd_lampu]) }}">Detail</a>
                              </form>
                            </td>
                          </tr>
                        @endforeach --}}
                      </tbody>
                    </thead>
                  </table>
                </div>
      </div>
</div>

{{-- importtlampu --}}

<div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <form method="post" action="{{ url('import_lampu')}}" enctype="multipart/form-data">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
            </div>
            <div class="modal-body">

              {{ csrf_field() }}

              <label>Pilih file excel</label>
              <div class="form-group">
                <input type="file" name="data_lampu" required="required">
              </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" value="Import">Import</button>
            </div>
          </div>
        </form>
      </div>
    </div>

@endsection

@section('footer')
  <script type="text/javascript">
    $(document).ready(function(){
      $.ajaxSetup({
        header: {
          'X-CSRF_TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
      });

      $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          url: " {{ route('lampu.index') }}"
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'no_lampu', name: 'no_lampu'},
            {data: 'kt_lampu', name: 'kt_lampu'},
            {data: 'kt_lampu1', name: 'kt_lampu1'},
            {data: 'kd_panel', name: 'kd_panel'},
            {data: 'kd_travo', name: 'kd_travo'},
            {data: 'kd_jalan', name: 'kd_jalan'},
            {data: 'kd_tiang', name: 'kd_tiang'},
            {data: 'kd_jaringan', name: 'kd_jaringan'},
            {data: 'latitude', name: 'latitude'},
            {data: 'longitude', name: 'longitude'},
            {data: 'ket', name: 'ket'},
            { data: 'gambar_lampu', name: 'gambar_lampu',
              render: function(data, type, full, meta){
                return "<img src={{ URL::to('public/') }}/uploads/" + data + " width='50' class='img-thumbnail' />";
              },
              orderable: false
            },
          { data: 'action', name: 'action', orderable: false },
        ]
      });
    });

    $('body').on('click', '.deleteLampu', function () {

       var travo_id = $(this).attr('id');
       if(confirm("Are You sure want to delete !"))
       {
         $.ajax({
          type:"get",
          url: "{{ url('lampu.destroy') }}"+ '/' + travo_id,
          success: function (data) {
             var oTable = $('#datatable').dataTable();
             oTable.fnDraw(false);
             },
          error: function (data) {
             console.log('Error:', data);
              }
          });
        }
   });
  </script>
@endsection
