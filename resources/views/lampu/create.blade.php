@extends('layouts.template')
@section('title')
  Tambah  Lampu
@endsection
@section('header')
  <link rel="stylesheet" href="{{asset('leaflet/leaflet.css')}}">
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
                          <form class="editableform" method="post" action="{{ route('lampu.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                  <label for="no_lampu">No Lampu</label>
                                  <input type="text" class="form-control" id="no_lampu" name="no_lampu" value="{{ old('no_lampu') }}" />
                                </div>

                                <div class="form-group">
                                  <label for="kt_lampu">Merek Lampu</label>
                                    <select class="form-control" name="kt_lampu" id="kt_lampu">
                                      <option value="">Pilih :</option>
                                        @foreach ($kategori as $row)
                                          <option value="{{ $row->kt_lampu }}">
                                              {{ $row->nama_lampu }}
                                              {{ $row->kt }}
                                              {{ $row->daya }}
                                          </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                  <label for="kd_panel" >No Panel</label>
                                    <select class="form-control" name="kd_panel" id="kd_panel">
                                        <option value="">Pilih :</option>
                                        @foreach ($panel as $row)
                                          <option value="{{ $row->kd_panel }}">{{ $row->no_panel }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                  <label for="kd_travo" >No Travo</label>
                                    <select class="form-control" name="kd_travo" id="kd_travo">
                                        <option value="">Pilih :</option>
                                        @foreach ($travo as $row)
                                          <option value="{{ $row->kd_travo }}">{{ $row->nama_travo }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                  <label for="kd_jalan">Nama Jalan</label>
                                    <select class="form-control" name="kd_jalan" id="kd_jalan">
                                        <option value="">Pilih :</option>
                                        @foreach ($jalan as $row)
                                          <option value="{{ $row->kd_jalan }}">{{ $row->nama_jalan }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                  <label for="kd_tiang">Jenis Tiang</label>
                                    <select class="form-control" name="kd_tiang" id="kd_tiang">
                                        <option value="">Pilih :</option>
                                        @foreach ($tiang as $row)
                                          <option value="{{ $row->kd_tiang }}">
                                            {{ $row->nm }}
                                            {{ $row->jns}}
                                            {{ $row->knt}}
                                            {{ $row->panjang}}
                                          </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                  <label for="kd_jaringan">Jenis Tiang</label>

                                    <select class="form-control" name="kd_jaringan" id="kd_jaringan">
                                        <option value="">Pilih :</option>
                                        @foreach ($jaringan as $row)
                                          <option value="{{ $row->kd_jaringan }}">
                                            {{ $row->nama_jaringan }}
                                            {{ $row->luas_penapang}}
                                          </option>
                                        @endforeach
                                    </select>

                                </div>

                                <div class="row">
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label for="latitude">Latitude</label>
                                            <input type="text" class="form-control" name="latitude" id="latitude"  placeholder="Latitude" required />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label for="longitude">Longitude</label>
                                            <input type="text" class="form-control" name="longitude" id="longitude" placeholder="Longitude" required />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                  <label for="ket">Keterangan</label>
                                      <select name="ket" id="ket" class="form-control">
                                        <option value="">Pilih</option>
                                        <option value="Hidup">Hidup</option>
                                        <option value="Mati">Mati</option>
                                      </select>
                                  </div>


                                <div class="form-group">
                                    <label for="gambar_lampu">Photo Lampu</label>
                                    <input type="file" class="form-control" id="gambar_lampu" name="gambar_lampu" value="{{ old('gambar_lampu') }}" />
                                </div>

                                <div class="box-footer">
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
  <script src="{{asset('leaflet/leaflet.js')}}"></script>
  <script src="{{ asset('js/jquery.min.js')}}"></script>
  <script>
      var maker;
      var map;

      function addMapPicker() {
        var mapCenter = [22, 87];
        var map = L.map('map').setView([0.913200, 104.488731], 13);
            mapLink = '<a href="http://openstreetmap.org">OpenStreetMap</a>';
            L.tileLayer(
            'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; ' + mapLink + ' Contributors',
            maxZoom: 18,
                }).addTo(map);
          //
          var marker = L.marker(mapCenter).addTo(map);
          var updateMarker = function(lat, lng) {
                  marker
                  .setLatLng([lat, lng])
                  .bindPopup("Travo location :  " + marker.getLatLng().toString())
                  .openPopup();
                  return false;
                  };

        map.on('click', function(e) {
            $('#latitude').val(e.latlng.lat);
            $('#longitude').val(e.latlng.lng);
            updateMarker(e.latlng.lat, e.latlng.lng);
            });
          //

        var updateMarkerByInputs = function() {
             return updateMarker( $('#latitude').val() , $('#longitude').val());
             }
             $('#latitude').on('input', updateMarkerByInputs);
              $('#longitude').on('input', updateMarkerByInputs);


          }

        function onMapClick(e) {
          marker = new L.marker(e.latlng, {id:uni, icon:redIcon, draggable:'true'});
          marker.on('dragend', function(event){
                  var marker = event.target;
                  var position = marker.getLatLng();
                  console.log(position);
                  marker.setLatLng(position,{id:uni,draggable:'true'}).bindPopup(position).update();
          });
          map.addLayer(marker);

          };

        $(document).ready(function() {
            addMapPicker();
            onMapClick(e);
            $('#btn btn-info btn-sm editable-submit').click(function() {
             $('.save-btn').editable('submit', {
                 url: '{{ route('marker.store')}}',
                 ajaxOptions: {
                 dataType: 'json' //assuming json response
                 }
             });
             $('.clearmap').editable('submit', {
                 url: '',
                 ajaxOptions: {
                 dataType: 'json' //assuming json response
                 }
             });
          });
      });

  </script>
@endsection
