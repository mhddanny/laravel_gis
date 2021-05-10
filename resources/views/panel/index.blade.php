@extends('layouts.template')

@section('title')
  Data Panel
@endsection
@section('content')
  @include('alert.succes')
  <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <a class="btn btn-sm btn-success" href="{{ route('panel.create') }}"><span class="glyphicon glyphicon-plus"></span> Create </a>
            <a class="btn btn-sm btn-primary" href="kordinat_panel" ><span class="glyphicon glyphicon-globe"></span> View </a>
            <a class="btn btn-sm  btn-info" href="{{ url('export_panel') }}"><span class="glyphicon glyphicon-export"></span>
               Export Excel</a>
            <button type="button" class="btn btn-sm btn-primary mr-5" data-toggle="modal" data-target="#importExcel"><span class="glyphicon glyphicon-import"></span>
              Import Excel
            </button>
          </div>
          <div class="box-body">
                  <table class="table table-bordered" id="datatable">
                    <thead>
                      <tr>
                        <th width="5%">No</th>
                        <th>Nama Panel</th>
                        <th>Nama Jalan</th>
                        <th>Nama Travo</th>
                        <th>Id Pel</th>
                        <th>Kategori</th>
                        <th>Daya KWH</th>
                        <th>Lat</th>
                        <th>Long</th>
                        <th>Photo Panel</th>
                        <th>Ket</th>
                        <th>Aktion</th>
                      </tr>
                      <tbody>
                        {{-- @foreach ($panel as $row)
                          <tr>
                            <td>{{ $loop->iteration + ($panel->perpage() * ($panel->currentPage() - 1 )) }}</td>
                            <td>{{ $row->no_panel }}</td>
                            <td>{{ $row->jalan->nama_jalan }}</td>
                            <td>{{ $row->travo->nama_travo }}</td>
                            <td>{{ $row->id_pel }}</td>
                            <td>{{ $row->daya_kwh }}</td>
                            <td>{{ $row->latitude }}</td>
                            <td>{{ $row->longitude }}</td>
                            <td class="text-center"><img class="img-thumbnail" src="{{ asset('uploads/'.$row->gambar_panel) }}" width="50px"></td>
                            <td class="text-center"><img class="img-thumbnail" src="{{ asset('uploads/'.$row->gbr) }}" width="50px"></td>
                            <td>
                              <form class="" action="{{ route('panel.destroy',[$row->kd_panel]) }}" method="post"
                                onsubmit="return confirm('Apakah Anda Yakin Akan Menghapus Data ini ?')">
                                @csrf
                                {{ method_field('Delete') }}
                                <a class="btn btn-warning" href="{{ route('panel.edit',[$row->kd_panel]) }}">Edit</a>
                                <button type="submit" name="button" class="btn btn-danger">Delete</button>
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
      <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      			<div class="modal-dialog" role="document">
      				<form method="post" action="{{ url('import_panel')}}" enctype="multipart/form-data">
      					<div class="modal-content">
      						<div class="modal-header">
      							<h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
      						</div>
      						<div class="modal-body">

      							{{ csrf_field() }}

      							<label>Pilih file excel</label>
      							<div class="form-group">
      								<input type="file" name="data_panel" required="required">
      							</div>

      						</div>
      						<div class="modal-footer">
      							<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
      							<button type="submit" class="btn btn-sm btn-primary">Import</button>
      						</div>
      					</div>
      				</form>
      			</div>
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
          url: "{{ route('panel.index') }}"
        },
        columns: [
          {data: 'DT_RowIndex', name: 'DT_RowIndex'},
          { data: 'no_panel', name: 'no_panel' },
          { data: 'kd_jalan', name: 'kd_jalan' },
          { data: 'kd_travo', name: 'kd_travo' },
          { data: 'id_pel', name: 'id_pel' },
          { data: 'kt_panel', name: 'kt_panel' },
          { data: 'daya_kwh', name: 'daya_kwh' },
          { data: 'latitude', name: 'latitude' },
          { data: 'longitude', name: 'longitude' },
          { data: 'gambar_panel', name: 'gambar_panel',
            render: function(data, type, full, meta){
              return "<img src={{ URL::to('public/') }}/uploads/" + data + " width='50' class='img-thumbnail' />";
            },
            orderable: false
          },
          { data: 'ket', name: 'ket' },
          { data: 'action', name: 'action', orderable: false },
        ]
      });
    });

      $('body').on('click', '.deletePanel', function() {
          var panel_id = $(this).attr('id');
          if (confirm('Are You sure to Delete !')) {
            $.ajax({
              type:"get",
              url: "{{ url('panel.destroy') }}"+ '/' + panel_id,
              success: function (data) {
                var oTable = $('#datatable').dataTable();
                oTable.fnDraw(false);
                },
              error: function (data) {
                console.log('Error:', data);
                }
            });
          }
      })
  </script>
@endsection
