@extends('layouts.template')
@section('title')
  Kordinat Lampu PJU
@endsection
@section('header')
  <link rel="stylesheet" href="{{asset('leaflet/leaflet.css')}}">
  <link rel="stylesheet" href="{{ asset('Leaflet.markercluster/dist/MarkerCluster.css')}}" />
  <link rel="stylesheet" href="{{ asset('Leaflet.markercluster/dist/MarkerCluster.Default.css')}}" />
  <link rel="stylesheet" href="{{ asset('leaflet-control-osm-geocoder-master/Control.OSMGeocoder.css')}}" />

  @endsection
@section('content')
  <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">

            <form method="get" action="{{ url('kordinat_marker') }}">
              <div class="form-group">
                <label for="keyword" class="col-sm-2 control-label">Search By Id Pel</label>
                <div class="col-sm-4">
                  <input type="text" class="form-control" id="keyword" name="keyword" value="{{Request::get('keyword')}}">
                </div>
                <div class="col-sm-6">
                  <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-search"></span></button>
                </div>
              </div>
            </form>

          </div>
          <div class="box-body">

            <div class="panel panel-primary">
              <div class="panel-heading"><span class="glyphicon glyphicon-globe"></span> Peta</div>
              <div style="width:100%; height:600px;" id="map"></div>
            </div>

          </div>
        </div>
      </div>
   </div>

@endsection
@section('footer')
<script type="text/javascript" src="{{asset('leaflet/leaflet.js')}}"></script>
<script src="{{ asset('Leaflet.markercluster/dist/leaflet.markercluster-src.js')}}"></script>
<script src="{{ asset('Leaflet.MarkerCluster.LayerSupport/leaflet.markercluster.layersupport-src.js') }}"></script>
<script src="{{ asset('leaflet-control-osm-geocoder-master/Control.OSMGeocoder.js')}}"></script>
  <script >
    var locations = <?php echo $hasil_lat_long; ?>;

      var map = L.map('map').setView([0.913240, 104.488691], 12);
     L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
         attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
     }).addTo(map);

     var osmGeocoder = new L.Control.OSMGeocoder({placeholder: 'Search location...'});

     var markers = L.markerClusterGroup({ disableClusteringAtZoom: 17 });

      for (var i = 0; i < locations.length; i++) {
       var marker = new L.marker([locations[i][1],locations[i][2]])
        .bindPopup(locations[i][0], locations[i][5])
        ;
        markers.addLayer(marker);
      }

      map.addLayer(markers).addControl(osmGeocoder);
   </script>




@endsection
