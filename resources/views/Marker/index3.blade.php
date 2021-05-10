@extends('layouts.template')
@section('title')
  Daftar Marker Lampu
@endsection

@section('header')
  <link rel="stylesheet" href="{{asset('leaflet/leaflet.css')}}">
  <script type="text/javascript" src="{{asset('leaflet/leaflet.js')}}"></script>
  <script type="text/javascript" src="{{ asset('js/jquery.min.js')}}"></script>
@endsection
@section('content')
  {{-- <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
  <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js" integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og==" crossorigin=""></script> --}}

  <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">

            @if (Request::get('keyword'))
              <a class="btn btn-success" href="{{ route('marker.index') }}"> Back </a>
            @else
              <a class="btn btn-success" href="{{ route('marker.create') }}"><span class="glyphicon glyphicon-plus"></span> Create </a>
            @endif

            <form method="get" action="{{route('marker.index')}}">
              <div class="form-group">
                <label for="keyword" class="col-sm-2 control-label">Search By Name</label>
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
            @if (Request::get('keyword'))
                <div class="alert alert-success alert-block">
                  Hasil Pencarian dengan keyword : <b>{{ Request::get('keyword') }}</b>
                </div>
            @endif

            @include('alert.succes')
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th width="5%">No</th>
                        <th>No Lampu</th>
                        <th>Lat</th>
                        <th>Long</th>
                        <th>Gambar</th>
                        <th>Action</th>
                      </tr>
                      <tbody>
                        @foreach ($marker as $row)
                          <tr>
                            <td>{{ $loop->iteration + ($marker->perpage() * ($marker->currentPage() - 1 )) }}</td>
                            <td>{{ $row->lampu->no_lampu }}</td>
                            <td>{{ $row->latitude }}</td>
                            <td>{{ $row->longitude }}</td>
                            <td><img class="img-thumbnail" src="{{ asset('uploads/'.$row->lampu->kategori->gbr) }}" width="30px"></td>
                            <td>
                              <form class="" action="{{ route('marker.destroy',[$row->marker_lampu]) }}" method="post"
                                onsubmit="return confirm('Apakah Anda Yakin Akan Menghapus Data ini ?')">
                                @csrf
                                {{ method_field('Delete') }}
                                <a class="btn btn-warning" href="{{ route('marker.edit',[$row->marker_lampu]) }}">Edit</a>
                                <button type="submit" name="button" class="btn btn-danger">Delete</button>
                                <a class="btn btn-info" href="{{ route('marker.show',[$row->marker_lampu]) }}">Detail</a>
                                <a class="btn btn-info" href="">Kordinat</a>
                              </form>
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </thead>
                  </table>
                {{ $marker->links() }}
                <div class="panel">
                  <div id="map" class="" style="width:100%; height:400px;"></div>

                </div>
                {{-- <script>
                  	var locations = <?php echo $hasil_lat_long; ?>;
                      var map = L.map('map').setView([{{ $lokasi->latitude }}, {{ $lokasi->longitude }}], 15);
                      mapLink = '<a href="http://openstreetmap.org">OpenStreetMap</a>';
                      L.tileLayer(
                          'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                          attribution: '&copy; ' + mapLink + ' Contributors',
                          maxZoom: 18,
                          }).addTo(map);

                          var myIcon = L.icon({
                              iconUrl: '{{ asset('uploads/'.$row->lampu->kategori->gbr) }}',
                              iconSize: [28, 35],
                              });

                		for (var i = 0; i < locations.length; i++) {
                			marker = new L.marker([locations[i][1],locations[i][2]], ({icon: myIcon}))
                				.bindPopup(locations[i][0])
                				.addTo(map);
                		} --}}
                    {{-- </script> --}}
              <script type="text/javascript">
                  var locations = <?php echo $hasil_lat_long; ?>;

                  var osmLink = '<a href="http://openstreetmap.org">OpenStreetMap</a>',
                      otmLink = '<a href="http://opentopomap.org/">OpenTopoMap</a>';

                  var osmUrl = 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
                      osmAttrib = '&copy; ' + osmLink + ' Contributors',
                      otmUrl = 'http://{s}.tile.opentopomap.org/{z}/{x}/{y}.png',
                      otmAttrib = '&copy; '+otmLink+' Contributors';

                  var osmMap = L.tileLayer(osmUrl, {attribution: osmAttrib}),
                      otmMap = L.tileLayer(otmUrl, {attribution: otmAttrib});

                  var map = L.map('map', {
                      layers: [osmMap] }) // only add one!
                      .setView([{{ $lokasi->latitude }}, {{ $lokasi->longitude }}], 15);

                  var myIcon = L.icon({
                      iconUrl: '{{ asset('uploads/'.$row->lampu->kategori->gbr) }}',
                      iconSize: [28, 35],
                      });
                  var baseLayers = {
                      "OSM Mapnik": osmMap,
                      "Topogrophy": otmMap
                      };

                for (var i = 0; i < locations.length; i++) {
                  marker = new L.marker([locations[i][1],locations[i][2]], ({icon: myIcon}))
                    .bindPopup(locations[i][0])
                    .addTo(map);
                }
                L.control.layers(baseLayers).addTo(map);

              </script>

              {{-- <script type="text/javascript">
                  var locations = <?php echo $hasil_lat_long; ?>;
                  var map = L.map('map').setView([0.913240, 104.488691], 13);

                  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                  attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                  }).addTo(map);

                  var myIcon = L.icon({
                    iconUrl: '{{asset('icons/office/office-building.png')}}',
                    iconSize: [20, 30],
                  });

                  $.getJSON("marker", function(hasil_lat_long){
                    $.each(hasil_lat_long, function(i, field){
                      alert(hasil_lat_long[i].kd_lampu);

                      marker = new L.marker([locations[i][1],locations[i][2]], ({icon: myIcon}))
                      .bindPopup("Nama Panel: {{ $lokasi->lampu->no_lampu}} <br> Travo : {{ $lokasi->lampu->panel->no_panel }}")
                      .addTo(map);
                    });
                  });

                  // L.marker([0.913240, 104.488691], ({icon: myIcon})).addTo(map)
                  // .bindPopup('A pretty CSS3 popup.<br> Easily customizable.')
                  // .openPopup();
              </script> --}}
          </div>
        </div>
      </div>
</div>
@endsection
