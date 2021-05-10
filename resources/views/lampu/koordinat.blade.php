@extends('layouts.template')
@section('title')
  Kordinat Lampu
@endsection
@section('header')
  <link rel="stylesheet" href="{{asset('leaflet/leaflet.css')}}">

    <script type="text/javascript" src="{{asset('leaflet/leaflet.js')}}"></script>
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
  <script type="text/javascript">
    var locations = <?php echo $hasil_lat_long; ?>;

      var map = L.map('map').setView([0.913240, 104.488691], 15);
     L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
         attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
     }).addTo(map);

      @foreach ($lampu as $row)
        var myIcon{{$row->kategori->kt_lampu}} = L.icon({
          iconUrl: '{{ asset('uploads/'.$row->kategori->gbr) }}',
          iconSize: [20, 35],
        });
        marker = new L.marker([{{ $row->latitude }},{{ $row->longitude }}], ({icon: myIcon{{ $row->kategori->kt_lampu}} }) )
        .bindPopup("No lampu :{{$row->no_lampu}}<br> Panel :{{ $row->travo->nama_travo}} <br>Alamat :{{ $row->jalan->nama_jalan }} <br> Jenis Lampu :{{ $row->kategori->kt }}, {{ $row->kategori->daya }}  ")
        .addTo(map);

      @endforeach
  </script>

@endsection
