@extends('layouts.template')

@section('title')
  Data travo
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
                        <form action="{{ route('travo.store') }}" class="editableform" method="post" enctype="multipart/form-data">
                          @csrf
                            <div class="form-group">
                                <label for="nama_travo">Nama Travo</label>
                                <input type="text" class="form-control" name="nama_travo" id="nama_travo"  placeholder="Nama Travo" value="{{ old('nama_travo') }}" />
                            </div>

                              <div class="form-group">
                                <label for="kd_jalan">Nama Jalan</label>
                                <select class="form-control" name="kd_jalan" id="kd_jalan">
                                  <option value="">Pillih</option>
                                    @foreach ($jalan as $row)
                                      <option value="{{ $row->kd_jalan }}" >{{ $row->nama_jalan}}</option>
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
                                <label for="rayon">Rayon</label>
                                <select class="form-control" name="rayon" id="rayon">
                                  <option value="">Pillih</option>
                                  <option value="Bintan Centre">Bintan Centre</option>
                                  <option value="Kota">Kota</option>
                                </select>
                              </div>

                              <div class="form-group">
                                  <label for="gambar_travo">Gambar Travo</label>
                                    <input type="file" class="form-control" id="gambar_travo" name="gambar_travo" value="{{ old('gambar_travo') }}">
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
          var marker = L.marker(mapCenter,{ pmIgnore: false }).addTo(map);
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
   {{-- <script>

      var osmUrl = 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
              osmAttrib = '&copy; <a href="http://openstreetmap.org/copyright">OpenStreetMap</a> contributors',
              osm = L.tileLayer(osmUrl, { maxZoom: 18, attribution: osmAttrib }),
              map = new L.Map('map', { center: new L.LatLng(0.913200, 104.488731), zoom: 13 }),
              drawnItems = L.featureGroup().addTo(map);
      L.control.layers({
          'osm': osm.addTo(map),
          "google": L.tileLayer('http://www.google.cn/maps/vt?lyrs=s@189&gl=cn&x={x}&y={y}&z={z}', {
              attribution: 'google'
          })
      }, { 'drawlayer': drawnItems }, { position: 'topleft', collapsed: false }).addTo(map);
      map.addControl(new L.Control.Draw({
          edit: {
              featureGroup: drawnItems,
              poly: {
                  allowIntersection: false
              }
          },
          draw: {
              polygon: {
                  allowIntersection: false,
                  showArea: true
              }
          }
      }));

      map.on(L.Draw.Event.CREATED, function (event) {
          var layer = event.layer;

          drawnItems.addLayer(layer);
      });
    </script> --}}

@endsection
