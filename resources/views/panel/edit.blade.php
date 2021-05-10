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
                        <form action="{{ route('panel.update',$panel->kd_panel) }}" class="editableform" method="post" enctype="multipart/form-data">
                        @csrf
                        {{ method_field('PUT')}}
                            <div class="form-group">
                                <label for="no_panel">Nama Panel</label>
                                <input type="text" class="form-control" name="no_panel" id="no_panel"  placeholder="Nama Panel" value="{{ $panel->no_panel }}"  />
                            </div>

                              <div class="form-group">
                                <label for="kd_jalan">Nama Jalan</label>
                                <select class="form-control" name="kd_jalan" id="kd_jalan">
                                  <option value="">Pilih :</option>
                                   @foreach ($jalan as $row)
                                     <option value="{{ $row->kd_jalan}}" @if ($panel->kd_panel == "$row->kd_jalan")
                                       selected
                                     @endif >{{ $panel->jalan->nama_jalan}}</option>
                                   @endforeach
                                </select>
                              </div>

                              <div class="form-group">
                                <label for="kd_travo">Nama Travo</label>
                                <select class="form-control" name="kd_travo" id="kd_travo">
                                  <option value="">Pilih : </option>
                                  @foreach ($travo as $row)
                                    <option value="{{ $row->kd_travo }}" @if ($panel->kd_panel == " $row->kd_travo")
                                      selected
                                    @endif >{{ $panel->travo->nama_travo}}</option>
                                  @endforeach
                                </select>
                              </div>


                            <div class="form-group">
                                <label for="id_pel">ID KWH</label>
                                <input type="text" class="form-control" name="id_pel" id="id_pel"  placeholder="ID PEL" value="{{ $panel->id_pel }}"/>
                            </div>

                            <div class="form-group">
                                <label for="daya_kwh">Daya Kwh</label>
                                <input type="text" class="form-control" name="daya_kwh" id="daya_kwh"  placeholder="Daya Kwh" value="{{ $panel->daya_kwh }}" />
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label for="latitude">Latitude</label>
                                        <input type="text" class="form-control" name="latitude" id="latitude"  placeholder="Latitude" value="{{ $panel->latitude }}" />
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label for="longitude">Longitude</label>
                                        <input type="text" class="form-control" name="longitude" id="longitude" placeholder="Longitude" value="{{ $panel->longitude }}" />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="gambar_panel">Photo Panel</label>
                                <img class="img-thumbnail" src="{{ asset('uploads/'.$panel->gambar_panel) }}" width="50px">
                            </div>

                            <div class="form-group">
                                <label for="gambar_panel">Photo Panel</label>
                                  <input type="file" class="form-control" id="gambar_panel" name="gambar_panel" value="{{ old('gambar_panel') }}">
                            </div>

                            <div class="form-group">
                                <label for="gbr">Photo Panel</label>
                                <img class="img-thumbnail" src="{{ asset('uploads/'.$panel->gbr) }}" width="50px">
                            </div>

                            <div class="form-group">
                                <label for="gbr">Maker</label>
                                  <input type="file" class="form-control" id="gbr" name="gbr" value="{{ old('gbr') }}">
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
  {{-- <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">

          </div>
          <div class="box-body">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th width="5%">No</th>
                        <th>Nama Panel</th>
                        <th>Nama Jalan</th>
                        <th>Nama Travo</th>
                        <th>Id Pel</th>
                        <th>Daya KWH</th>
                        <th>Lat</th>
                        <th>Long</th>
                        <th>Gambar Travo</th>
                      </tr>
                      <tbody>
                        @foreach ($panel as $row)
                          <tr>
                            <td>{{ $loop->iteration + ($panel->perpage() * ($panel->currentPage() - 1 )) }}</td>
                            <td>{{ $row->no_panel }}</td>
                            <td>{{ $row->jalan->nama_jalan }}</td>
                            <td>{{ $row->travo->nama_travo }}</td>
                            <td>{{ $row->id_pel }}</td>
                            <td>{{ $row->daya_kwh }}</td>
                            <td>{{ $row->latitude }}</td>
                            <td>{{ $row->longitude }}</td>
                            <td><img class="img-thumbnail" src="{{ asset('uploads/'.$row->gambar_panel) }}" width="100px"></td>
                          </tr>
                        @endforeach
                      </tbody>
                    </thead>
                  </table>
                {{ $panel->links() }}
                <div class="panel">
                  <div id="map" class="" style="width:100%; height:400px;"></div>

                </div>

              </script>
          </div>
        </div>
      </div>
  </div> --}}
@endsection
@section('footer')

  <script type="text/javascript" src="{{asset('leaflet/leaflet.js')}}"></script>
  <script>
    var locations = <?php echo $hasil_lat_long; ?>;;



                  var curLocation = [0, 0];

                  if (curLocation[0] == 0 && curLocation[1] == 0) {
                    curLocation = [{{ $panel->latitude }}, {{ $panel->longitude }}];
                  }

                  var map = L.map('map').setView(curLocation, 15);

                  L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
                  }).addTo(map);

                  map.attributionControl.setPrefix(false);

                  var marker = new L.marker(curLocation, {
                    draggable: 'true'
                  })
                  .bindPopup("Nama Panel: {{ $panel->no_panel}} <br> Travo : {{ $panel->travo->nama_travo }}")
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
