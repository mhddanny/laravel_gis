@extends('layouts.template')

@section('title')
  Data Travo
@endsection
@section('header')
  {{-- <link rel="stylesheet" href="{{asset('leaflet/leaflet.css')}}"> --}}
@endsection
@section('content')
  <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            @include('alert.error')
            <a class="btn btn-sm btn-success" href="{{ route('travo.create') }}"><span class="glyphicon glyphicon-plus"></span> Create </a>
            <a class="btn btn-sm btn-primary" href="kordinat_travo" ><span class="glyphicon glyphicon-globe"></span> View </a>
            <a class="btn btn-sm  btn-info" href="{{ route('export_travo') }}"><span class="glyphicon glyphicon-export"></span>
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
                        <th width="5%">No</th>
                        <th>Nama Travo</th>
                        <th>Nama Jalan</th>
                        <th>Lat</th>
                        <th>Long</th>
                        <th>Rayon</th>
                        <th>Gambar Travo</th>
                        <th>Aktion</th>
                      </tr>
                      <tbody>
                        {{-- @php $i=1 @endphp
                        @foreach ($travo as $row)
                          <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $row->nama_travo }}</td>
                            <td>{{ $row->jalan->nama_jalan}}</td>
                            <td>{{ $row->latitude }}</td>
                            <td>{{ $row->longitude }}</td>
                            <td>{{ $row->rayon }}</td>
                            <td><img class="img-thumbnail" src="{{ asset('uploads/'.$row->gambar_travo) }}" width="50px"></td>
                            <td>
                              <form class="" action="{{ route('travo_pln.destroy',[$row->kd_travo]) }}" method="post"
                                onsubmit="return confirm('Apakah Anda Yakin Akan Menghapus Data ini ?')">
                                @csrf
                                {{ method_field('Delete') }}
                                <a class="btn btn-warning" href="{{ route('travo_pln.edit',[$row->kd_travo]) }}">Edit</a>
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
    {{-- <div class="panel">
      <div id="map" class="" style="width:100%; height:400px;"></div>
    </div> --}}
{{-- //modal --}}
<div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<form method="post" action="{{ url('import_travo') }}" enctype="multipart/form-data">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
						</div>
						<div class="modal-body">

							{{ csrf_field() }}

							<label>Pilih file excel</label>
							<div class="form-group">
								<input type="file" name="data_travo" required="required">
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
          url: "{{ route('travo.index')}}"
        },
        columns: [
          {data: 'DT_RowIndex', name: 'DT_RowIndex'},
          { data: 'nama_travo', name: 'nama_travo'},
          { data: 'kd_jalan', name: 'kd_jalan' },
          { data: 'latitude', name: 'latitude' },
          { data: 'longitude', name: 'longitude' },
          { data: 'rayon', name: 'rayon'},
          { data: 'gambar_travo', name: 'gambar_travo',
            render: function(data, type, full, meta){
             return "<img src={{ URL::to('public/') }}/uploads/" + data + " width='70' class='img-thumbnail' />";
              },
            orderable: false
          },
          { data: 'action', name: 'action',orderable: false },
        ]
      });
    });

      $('body').on('click', '.deleteTravo', function () {

         var travo_id = $(this).attr('id');
         if(confirm("Are You sure want to delete !"))
         {
           $.ajax({
            type:"get",
            url: "{{ url('travo.destroy') }}"+ '/' + travo_id,
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

  {{-- <script type="text/javascript" src="{{asset('leaflet/leaflet.js')}}"></script>
  <script>
    var locations = <?php echo $hasil_lat_long; ?>;

      var map = L.map('map', {drawControl: true}).setView([{{ $lokasi->latitude }}, {{ $lokasi->longitude }}], 15);
     L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
         attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
     }).addTo(map);

      for (var i = 0; i < locations.length; i++) {
        marker = new L.marker([locations[i][1],locations[i][2]])
        .bindPopup(locations[i][0])
        .addTo(map);
      }

  </script> --}}
@endsection
