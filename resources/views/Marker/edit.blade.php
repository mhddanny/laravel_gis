@extends('layouts.template')
@section('title')
  Edit  Maker Lampu
@endsection

@section('header')
   {{-- csss leaflet google map  --}}
    <link rel="stylesheet" href="{{ asset('leaflet/leaflet.css')}}">
    {{-- css datatable --}}
    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>

    <!--script leaflet google map-->
    <script type="text/javascript" src="{{ asset('leaflet/leaflet.js')}}"></script>
    {{-- script jquery --}}
    <script src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.min.js')}}"></script>
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          @include('alert.error')
        </div>
            <div class="box-body">
              <div class="col-md-3 col-sm-3">
                <div class="panel panel-primary">
                  <div class="panel-heading"><span class="glyphicon glyphicon-map-marker"></span> Daftar Koordinat</div>
                    <div class="panel-body" style="min-height:300px;">
                      <form class="form-horizontal" method="post" action="{{ route('marker.update',[$marker->id]) }}" enctype="multipart/form-data">
                        @csrf
                        {{ method_field('PUT') }}
                          {{-- <div class="form-group">
                            <label for="kd_lampu" class="col-sm-2 control-label">Merek Lampu</label>
                            <div class="col-sm-10">
                              <select class="form-control" name="kd_lampu" id="kd_lampu">
                                <option value="">Pilih</option>
                                  @foreach ($lampu as $row)
                                    <option value="{{ $row->kd_lampu}}" @if ($marker->marker_lampu == " $row->kd_lampu")
                                      selected
                                    @endif>{{ $row->no_lampu }}</option>
                                  @endforeach
                              </select>
                            </div>
                          </div> --}}

                          <div class="form-group">
                            <label for="nama_jalan" class="col-sm-2 control-label">Nama Jalan</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="nama_jalan" name="nama_jalan" value="{{ $marker->nama_jalan }}">
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="kel" class="col-sm-2 control-label">Kelurahan</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="kel" name="kel" value="{{ $marker->kel }}">
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="rt_rw" class="col-sm-2 control-label">Kecamatan</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="kec" name="kec" value="{{ $marker->kec }}">
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="rt_rw" class="col-sm-2 control-label">Rt/Rw</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="rt_rw" name="rt_rw" value="{{ $marker->rt_rw }}">
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="latitude" class="col-sm-2 control-label">Lat</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="latitude" name="latitude" value="{{ $marker->lat }}">
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="longitude" class="col-sm-2 control-label">Long</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="longitude" name="longitude" value="{{ $marker->long }}">
                            </div>
                          </div>

                          {{-- <div class="form-group">
                              <label for="gambar_lampu" class="col-sm-2 control-label">Gambar Lampu</label>
                              <div class="col-sm-10">
                                <img class="img_thumbnail" src="{{ asset('uploads/'.$marker->gbr)}}" width="50px">
                              </div>
                          </div>

                          <div class="form-group">
                            <label for="gbr" class="col-sm-2 control-label">Marker</label>
                              <div class="col-sm-10">
                                <input type="file" class="form-control" id="gbr" name="gbr" value="{{ $marker->gbr }}">
                              </div>
                          </div> --}}

                          </div>
                          <!-- /.box-body -->
                        <div class="box-footer">
                            <button class="btn btn-info btn-sm editable-cancel " onclick="updateData()" id="update"><span class="glyphicon glyphicon-globe"></span> Update</button>
                        </div>
                        <!-- /.box-footer -->
                      </form>
                    </div>
                  </div>

              <div class="col-md-9 col-sm-9">
                <div class="panel panel-primary">
                    <div class="panel-heading"><span class="glyphicon glyphicon-globe"></span> Peta</div>
                      <div style="width:100%; height:500px;" id="map"></div>
                </div>
              </div>

            </div>
          </div>
      </div>
  </div>
@endsection
@section('footer')
  <script>
    var map;
    var marker;
      $(function() {
        var locations = <?php echo $hasil_lat_long; ?>;
    // use below if you want to specify the path for leaflet's images
    //L.Icon.Default.imagePath = '@Url.Content("~/Content/img/leaflet")';

      var curLocation = [0, 0];
      // use below if you have a model
      // var curLocation = [@Model.Location.Latitude, @Model.Location.Longitude];

      if (curLocation[0] == 0 && curLocation[1] == 0) {
        curLocation = [{{$marker->lat}}, {{ $marker->long}}];
      }

      var map = L.map('map').setView(curLocation, 15);

      L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
      }).addTo(map);

      map.attributionControl.setPrefix(false);

      var marker = new L.marker(curLocation,
        {draggable: 'true'})
        .bindPopup("Id Lampu: {{ $marker->id_pel}} <br> Travo : {{ $marker->st_panel }}")
        .addTo(map);

      marker.on('dragend', function(event) {
        var position = marker.getLatLng();
        marker.setLatLng(position, {
          draggable: 'true'
        }).bindPopup(position).update();
        $("#latitude").val(position.lat);
        $("#longitude").val(position.lng).keyup();
      });

      $("#latitude, #longitude").change(function() {
        var position = [parseInt($("#latitude").val()), parseInt($("#longitude").val())];
        marker.setLatLng(position, {
          draggable: 'true'
        }).bindPopup(position).update();
        map.panTo(position);
      });

      map.addLayer(marker);
      })
  </script>
@endsection
