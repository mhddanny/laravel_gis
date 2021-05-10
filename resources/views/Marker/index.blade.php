@extends('layouts.template')
@section('title')
  Maker Lampu
@endsection
@section('header')

    <meta name="@csrf" content="{{ csrf_token() }}">

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
              @include('alert.succes')
              <div class="col-md-3 col-sm-3">
                  <div class="panel panel-primary">
                      <div class="panel-heading"><span class="glyphicon glyphicon-map-marker"></span> Daftar Koordinat</div>
                      <div class="panel-body" style="min-height:300px;">
                          <form action="#" class="" method="post" enctype="multipart/form-data">
                          @csrf
                            <div class="form-group">
                              <label for="kd_lampu">Nama Lampu</label>
                                <select class="form-control" name="kd_lampu" id="kd_lampu" required>
                                  <option value="">Pillih</option>
                                  @foreach ($lampu as $row)
                                    <option value="{{ $row->kd_lampu }}" >{{ $row->no_lampu }}</option>
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
                                  <button class="btn btn-info btn-sm editable-submit" onclick="saveData()" id="save"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                                  {{-- <button class="btn btn-info btn-sm editable-cancel " onclick="updateData()" id="update"><span class="glyphicon glyphicon-globe"></span> Update</button> --}}
                              </div>
                          </form>
                  </div>
                </div>
              </div>


              <div class="col-md-9 col-sm-9">
                  <div class="panel panel-primary">
                      <div class="panel-heading"><span class="glyphicon glyphicon-globe"></span> Peta</div>
                        <div style="width:100%; height:400px;" id="map"></div>
                  </div>
              </div>
        <div class="col-md-12 col-sm-12">
          <div class="panel panel-primary">
              <div class="panel-heading"><span class="glyphicon glyphicon-th-list"></span> Data Koordinat marker Data Lampu</div>
              <div class="panel-body" style="min-height:400px">
                  <table class="table" id="datatable">
                    <tr>
                      <th>No</th>
                      <th>kode lampu</th>
                      <th>Latitude</th>
                      <th>Longitude</th>
                      <th>Action</th>
                    </tr>
                      <tbody id="">
                        @foreach ($marker as $row)
                          <tr>
                            <td>{{ $loop->iteration + ($marker->perpage() * ($marker->currentPage() - 1 )) }}</td>
                            <td>{{ $row->lampu->no_lampu }}</td>
                            <td>{{ $row->latitude }}</td>
                            <td>{{ $row->longitude}}</td>
                            <td><img class="img-thumbnail" src="{{ asset('uploads/'.$row->gbr) }}" width="50px"></td>
                            <td>
                              <form class="" action="{{ route('marker.destroy',[$row->marker_lampu]) }}" method="post"
                                onsubmit="return confirm('Apakah Anda Yakin Akan Menghapus Data ini ?')">
                                @csrf
                                {{ method_field('Delete') }}
                                <a class="btn btn-warning" id="edit" onclick="editData()" href="{{ route('marker.edit',[$row->marker_lampu]) }}">Edit</a>
                                <button type="submit" name="button" id="delete" onclick="daleteData()" class="btn btn-danger">Delete</button>
                                <a class="btn btn-info btn-sm editable-show" id="show" href="{{ route('marker.show',[$row->marker_lampu]) }}">Detail</a>
                                {{-- <a class="btn btn-info" id="ko" href="">Kordinat</a>
                              </form> --}}
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                  </table>
              </div>
          </div>
        </div>
          </div>
        </div>
      </div>
  </div>
@endsection
@section('footer')

  <script type="text/javascript">
          // var map = L.map('map').setView([0.913200, 104.488731], 13);
          //
          // L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          //   maxZoom: 18,
          //   attribution: ''
          //   }).addTo(map);
          //
          //   $.getJSON("{{ route('marker.index')}}", function(result){
          //     $.each(result, function(i, field){
          //       alert(result(i));
          //       //$("div").append(field + " ");
          //     });
          //   });
          //
          // L.marker([0.913200, 104.488731]).addTo(map)
          //   .bindPopup('kantor PERKiM.<br> PJU Tanjungpinang.')
          //   .openPopup();

  </script>
  <script>
    var map;
    var marker;
     var locations = <?php echo $hasil_lat_long; ?>;
    function viewData(){

      var coolPlaces = new L.LayerGroup();

     var osmLink = '<a href="http://openstreetmap.org">OpenStreetMap</a>',
         otmLink = '<a href="http://opentopomap.org/">OpenTopoMap</a>';

     var osmUrl = 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
         osmAttrib = '&copy; ' + osmLink + ' Contributors',
         otmUrl = 'http://{s}.tile.opentopomap.org/{z}/{x}/{y}.png',
         otmAttrib = '&copy; '+otmLink+' Contributors';

     var osmMap = L.tileLayer(osmUrl, {attribution: osmAttrib}),
         otmMap = L.tileLayer(otmUrl, {attribution: otmAttrib});

     var map = L.map('map', {
         layers: [osmMap] // only add one!
  	    })
        .setView([0.913200, 104.488731], 16);

    @foreach ($data as $row)
        var myIcon{{$row->kd_pane}} = L.icon({
          iconUrl: '{{ asset('uploads/'.$row->gbr) }}',
          iconSize: [15, 25]
        });
        marker = new L.marker([{{ $row->latitude }},{{ $row->longitude }}], ({icon: myIcon{{$row->kd_pane}}}))
        .bindPopup("No Panel :{{$row->no_panel}}")
        .addTo(map);

    @endforeach

     var baseLayers = {
  	   "OSM Mapnik": osmMap,
  	   "Topogrophy": otmMap
  	    };

     var overlays = {
  	   "Interesting places": coolPlaces
         };

      var updateMarker = function(lat, lng) {
          marker
          .setLatLng([lat, lng])
          .bindPopup("New location :  " + marker.getLatLng().toString())
          .openPopup();
          };

    var map = map.on('click', function(e) {
         $('#latitude').val(e.latlng.lat);
         $('#longitude').val(e.latlng.lng);
         updateMarker(e.latlng.lat, e.latlng.lng);
         	});

     L.control.layers(baseLayers,overlays,updateMarker).addTo(map);

      // var osmLink = '<a href="http://openstreetmap.org">OpenStreetMap</a>',
      //   otmLink = '<a href="http://opentopomap.org/">OpenTopoMap</a>';
      //
      //   var osmUrl = 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
      //       osmAttrib = '&copy; ' + osmLink + ' Contributors',
      //       otmUrl = 'http://{s}.tile.opentopomap.org/{z}/{x}/{y}.png',
      //       otmAttrib = '&copy; '+otmLink+' Contributors';
      //
      //   var osmMap = L.tileLayer(osmUrl, {attribution: osmAttrib}),
      //       otmMap = L.tileLayer(otmUrl, {attribution: otmAttrib});
      //
      //   map = L.map('map', {
      //       layers: [osmMap] // only add one!
      //      })
      //        .setView([0.913178, 104.488703], 14);
      //
      //   var baseLayers = {
      //     "OSM Mapnik": osmMap,
      //     "Topogrophy": otmMap
      //      };
      //
      //   L.control.layers(baseLayers).addTo(map);
    }

    function addMarker(){
      var updateMarkerByInputs =  function() {
      return updateMarker( $('#latitude').val() , $('#longitude').val());
    }
         $('#latitude').on('input', updateMarkerByInputs);
         $('#longitude').on('input', updateMarkerByInputs);

    }

    $(document).ready(function() {
      viewData();
      addMarker();

      $('#btn btn-info btn-sm editable-submit').click(function() {
                $('.save').editable('submit', {
                    url: '{{ route('marker.store')}}',
                    ajaxOptions: {
                      dataType: 'json' //assuming json response
                    },
                    success: function(response){
                    viewData(); //assuming json response
                    }

               });
          });
    });

  </script>

 <script type="text/javascript">
    // $(#datatable).DataTable();
    // $(#save).show();
    // $(#update).hide();
    // $(#myid).hide();
    //
    // var map;
    // var marker;

    // function addMapPicker() {
    //   var mapCenter = [22, 87];
    //   var map = L.map('map').setView([0.913200, 104.488731], 18);
    //       mapLink = '<a href="http://openstreetmap.org">OpenStreetMap</a>';
    //       L.tileLayer(
    //       'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    //       attribution: '&copy; ' + mapLink + ' Contributors',
    //       maxZoom: 18,
    //           }).addTo(map);
        //
    //     var marker = L.marker(mapCenter).addTo(map);
    //     var updateMarker = function(lat, lng) {
    //             marker
    //             .setLatLng([lat, lng])
    //             .bindPopup("Your location :  " + marker.getLatLng().toString())
    //             .openPopup();
    //             return false;
    //             };
    //
    //   map.on('click', function(e) {
    //       $('#latitude').val(e.latlng.lat);
    //       $('#longitude').val(e.latlng.lng);
    //       updateMarker(e.latlng.lat, e.latlng.lng);
    //       });
    //     //
    //
    //   var updateMarkerByInputs = function() {
    //        return updateMarker( $('#latitude').val() , $('#longitude').val());
    //        }
    //        $('#latitude').on('input', updateMarkerByInputs);
    //         $('#longitude').on('input', updateMarkerByInputs);
    //     }
    //
    //   $(document).ready(function() {
    //       addMapPicker();
    // });
    //
    // function viewData(){
    //   ajax({
    //     type : "GET",
    //     dataType : "json",
    //     url : "/marker",
    //     success : function(response){
    //       var rows = "";
    //       $.each(response.data, function(key, value){
    //         row = rows + "<tr>";
    //         row = rows + "<td>"+value.marker_lampu+"</td>";
    //         row = rows + "<td>"+value.kd_lampu+"</td>";
    //         row = rows + "<td>"+value.Latitude+"</td>";
    //         row = rows + "<td>"+value.Longitude+"</td>";
    //         row = rows + "<tr>";
    //         row = rows + "<button type='button'> onclick='editData("+value.marker_lampu+","+value.kd_lampu",
    //                     "+value.Latitude+","+value.Longitude+")'></button>";
    //         row = rows + "<button type='button' onclick='deletData("+value.marker_lampu")'></button>";
    //         row = rows + "</td></tr>";
    //       });
    //       $('body').html(row);
    //     }
    //   })
    // }
    //
    // function saveData(){
    //   var kd_lampu = $(#kd_lampu).val();
    //   var Latitude = $(#Latitude).val();
    //   var Longitude = $(#Longitude).val();
    //     $.ajax({
    //       type : 'POST',
    //       dataType : 'json',
    //       data : (kd_lampu:kd_lampu, Latitude:Latitude, Longitude:Longitude),
    //       url: 'marker.store',
    //       success: function(response){
    //         viewData();
    //         clearData()
    //         $(#save).show();
    //         $('.myid').hide();
    //       }
    //     })
    // }
    //
    // function clearData(){
    //   $('#kd_lampu').val('');
    //   $('#Latitude').val('');
    //   $('#Longitude').val('');
    // }
    //
    // function editData(kd_lampu, latitude, longitude){
    //   $('#save').show();
    //   $('#update').show();
    //   $('.myid').show();
    //   $.ajax({
    //     type: "GET",
    //     dataType: "json",
    //     url: "/marker/"+id+"/edit",
    //     succes: function(response){
    //       $('#marker_lampu').val(response.marker_lampu);
    //       $('#kd_lampu').val(response.kd_lampu);
    //       $('#latitude').val(response.latitude);
    //       $('#longitude').val(response.longitude);
    //     }
    //   })
    // }
    //
    // function updateData(){
    //   var kd_lampu = $(#kd_lampu).val();
    //   var Latitude = $(#Latitude).val();
    //   var Longitude = $(#Longitude).val();
    //
    // }
    //
    // function deletData($id){
    //   $.ajax({
    //     type: "DELETTE",
    //     dataType: "json",
    //     url: 'marker'+id,
    //     success: function(response){
    //       viewData();
    //     }
    //   })
    // }

 </script>

@endsection
