@extends('layouts.template')

@section('title')
  Data Kordinat Panel
@endsection
@section('header')
  <link rel="stylesheet" href="{{asset('leaflet/leaflet.css')}}">
@endsection
@section('content')
  <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">

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
  <script type="text/javascript">
  var locations = <?php echo $hasil_lat_long; ?>;

    var map = L.map('map').setView([0.913240, 104.488691], 15);
   L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
       attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
   }).addTo(map);

    @foreach ($panel as $row)
    var myIcon{{$row->kd_panel}} = L.icon({
      iconUrl: '{{ asset('uploads/'.$row->gbr) }}',
      iconSize: [20, 35],
    });
    marker = new L.marker([{{ $row->latitude }},{{ $row->longitude }}], ({icon: myIcon{{$row->kd_panel}}}))
    .bindPopup("No Panel :{{$row->no_panel}}")
    .addTo(map);

    @endforeach

</script>
@endsection
