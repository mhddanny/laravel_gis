@extends('layouts.template')

@section('title')
  Data Jalan
@endsection
@section('header')


@endsection
@section('content')
  <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              @include('alert.error')
              <a class="btn btn-sm btn-success" href="{{ route('jalan.create') }}"><span class="glyphicon glyphicon-plus"></span> Create </a>
              <a class="btn btn-sm btn-info" href="{{ url('export_jalan') }}"><span class="glyphicon glyphicon-export"></span>
                 Export File</a>
              <button type="button" class="btn btn-primary mr-5 btn-sm" data-toggle="modal" data-target="#importExcel"><span class="glyphicon glyphicon-import"></span>
          			Import Excel
          		</button>
            </div>
            <div class="box-body">
              @include('alert.succes')
                <table class="table table-bordered" id="datatable">
                  <thead>
                    <tr>
                      <th width="5%">No</th>
                      <th>Nama Jalan</th>
                      <th>Kelurahan</th>
                      <th>Kecamatan</th>
                      <th>Rt/Rw</th>
                      <th width="30%">Ation</th>
                    </tr>
                    <tbody>
                        {{-- @php $i=1 @endphp
                        @foreach ($jalan as $row)
                            <tr>
                              <td>{{ $i++ }}</td>
                              <td>{{ $row->nama_jalan }}</td>
                              <td>{{ $row->kel }}</td>
                              <td>{{ $row->kec }}</td>
                              <td>
                                <form class="" action="{{ route('jalan.destroy',[$row->kd_jalan]) }}" method="post"
                                  onsubmit="return confirm('Apakah Anda Yakin Akan Menghapus Data ini ?')">
                                  @csrf
                                  {{ method_field('Delete') }}
                                  <a class="btn btn-warning" href="{{ route('jalan.edit',[$row->kd_jalan]) }}">Edit</a>
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
</div>
<div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<form method="post" action="{{ url('import_jalan')}}" enctype="multipart/form-data">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
						</div>
						<div class="modal-body">

							{{ csrf_field() }}

							<label>Pilih file excel</label>
							<div class="form-group">
								<input type="file" name="data_jalan" required="required">
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
    $(document).ready(function(){
      $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
       });

      $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax:{
          url: "{{ route('jalan.index')}}"
        },
        columns: [
          {data: 'DT_RowIndex', name: 'DT_RowIndex'},
          { data: 'nama_jalan', name: 'nama_jalan'},
          { data: 'kel', name: 'kel' },
          { data: 'kec', name: 'kec' },
          { data: 'rt_rw', name: 'rt_rw'},
          { data: 'action', name: 'action',orderable: false },
        ]
      });
    });

      $('body').on('click', '.deleteJalan', function () {

         var jalan_id = $(this).attr('id');
         if(confirm("Are You sure want to delete !"))
         {
           $.ajax({
            type:"get",
            url: "{{ url('jalan.destroy') }}"+ '/' + jalan_id,
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
