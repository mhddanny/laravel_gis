@extends('layouts.template')

@section('title')
  Data Panel
@endsection
@section('header')
  <link rel="stylesheet" href="{{asset('leaflet/leaflet.css')}}">
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
                        <form action="{{ route('travo.update',$travo->kd_travo) }}" class="editableform" method="post" enctype="multipart/form-data">
                        @csrf
                        {{ method_field('PUT')}}
                            <div class="form-group">
                                <label for="nama_travo">Nama Travo</label>
                                <input type="text" class="form-control" name="nama_travo" id="nama_travo"  placeholder="Nama Panel" value="{{ $travo->nama_travo }}"  />
                            </div>

                              <div class="form-group">
                                <label for="kd_jalan"> Jalan</label>
                                <select class="form-control" name="kd_jalan" id="kd_jalan">
                                  @foreach ($jalan as $row)
                                  <option value="{{ $row->kd_jalan }}" @if ($travo->kd_travo == $row->kd_jalan)
                                  selected 
                                    @endif>{{ $travo->jalan->nama_jalan }}  
                                  </option>
                                  @endforeach
                                </select>
                              </div>

                              <div class="row">
                                  <div class="col-md-6 col-sm-6">
                                      <div class="form-group">
                                          <label for="latitude">Latitude</label>
                                          <input type="text" class="form-control" name="latitude" id="latitude"  placeholder="Latitude" value="{{ $travo->latitude }}" />
                                      </div>
                                  </div>
                                  <div class="col-md-6 col-sm-6">
                                      <div class="form-group">
                                          <label for="longitude">Longitude</label>
                                          <input type="text" class="form-control" name="longitude" id="longitude" placeholder="Longitude" value="{{ $travo->longitude }}" />
                                      </div>
                                  </div>
                              </div>

                              <div class="form-group">
                                <label for="rayon">Rayon</label>
                                <select class="form-control" name="rayon" id="rayon">
                                  <option value="">Pillih</option>
                                  <option value="Bintan Centre" @if ($travo->rayon == 'Bintan Centre')
                                    selected
                                  @endif>Bintan Centre</option>
                                  <option value="Kota" @if ($travo->rayon == 'Kota')
                                    selected
                                  @endif>Kota</option>
                                </select>
                              </div>


                            <div class="form-group">
                                <label for="gambar_travo">Photo Travo</label>
                                <img class="img-thumbnail" src="{{ asset('uploads/'.$travo->gambar_travo) }}" width="50px">
                            </div>

                            <div class="form-group">
                                <label for="gambar_travo">Photo Travo</label>
                                  <input type="file" class="form-control" id="gambar_travo" name="gambar_travo" value="{{ old('gambar_Travo') }}">
                            </div>

                            <div class="form-group">
                              <button type="submit" name="tombol" class="btn btn-info pull-right">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
                </div>

                <div class="col-md-9 col-sm-9">
                  <div class="panel panel-primary">
                    <div class="panel-heading"><span class="glyphicon glyphicon-globe"></span> Peta</div>
                    <div style="width:100%; height:650px;" id="map"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
    </div>
@endsection
@section('footer')

  <script type="text/javascript" src="{{asset('leaflet/leaflet.js')}}"></script>
  <script>
    var locations = <?php echo $hasil_lat_long; ?>;;
                  var curLocation = [0, 0];

                  if (curLocation[0] == 0 && curLocation[1] == 0) {
                    curLocation = [{{ $travo->latitude }}, {{ $travo->longitude }}];
                  }

                  var map = L.map('map').setView(curLocation, 15);

                  L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
                  }).addTo(map);

                  map.attributionControl.setPrefix(false);

                  var marker = new L.marker(curLocation, {
                    draggable: 'true'
                  })
                  .bindPopup("Nama Panel: {{ $travo->nama_travo}} ")
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
    </script>
@endsection
