@extends('layouts.template')
@section('title')
  Update  Lampu
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
                          <form class="editableform" method="post" action="{{ route('lampu.update',[$lampu->kd_lampu]) }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <div class="form-group">
                              <label for="no_lampu">No Lampu</label>
                                <input type="text" class="form-control" id="no_lampu" name="no_lampu" value="{{ $lampu->no_lampu }}">
                            </div>

                            <div class="form-group">
                              <label for="kt_lampu">Merek Lampu</label>
                                <select class="form-control" name="kt_lampu" id="kt_lampu">
                                    @foreach ($kategori as $row)
                                      <option value="{{ $row->kt_lampu }}" @if ($lampu->kd_lampu == $row->kt_lampu)
                                        selected
                                      @endif>
                                          {{ $lampu->kategori->nama_lampu }}
                                          {{ $lampu->kategori->kt }}
                                          {{ $lampu->kategori->daya }}
                                      </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                              <label for="kd_panel">No Panel</label>
                                <select class="form-control" name="kd_panel" id="kd_panel">
                                    @foreach ($panel as $row)
                                      <option value="{{ $row->kd_panel }}" @if ($lampu->kd_lampu == $row->kd_panel)
                                        selected
                                      @endif>{{ $lampu->panel->no_panel }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                              <label for="kd_travo">No Travo</label>
                                <select class="form-control" name="kd_travo" id="kd_travo">
                                    @foreach ($travo as $row)
                                      <option value="{{ $row->kd_travo }}" @if ($lampu->kd_lampu == $row->kd_travo)
                                        selected
                                      @endif>{{ $lampu->travo->nama_travo }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                              <label for="kd_jalan">Nama Jalan</label>
                                <select class="form-control" name="kd_jalan" id="kd_jalan">
                                    @foreach ($jalan as $row)
                                      <option value="{{ $row->kd_jalan }}" @if ($lampu->kd_lampu == $row->kd_jalan)
                                        selected
                                      @endif>{{ $lampu->jalan->nama_jalan }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                              <label for="kd_tiang">Jenis Tiang</label>
                                <select class="form-control" name="kd_tiang" id="kd_tiang">
                                    @foreach ($tiang as $row)
                                      <option value="{{ $row->kd_tiang }}" @if ($lampu->kd_lampu == $row->kd_tiang)
                                        selected
                                      @endif>
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
                                    @foreach ($jaringan as $row)
                                      <option value="{{ $row->kd_jaringan }}" @if ($lampu->kd_lampu == $row->kd_jaringan)
                                        selected
                                      @endif>
                                        {{ $row->nama_jaringan }}
                                        {{ $row->luas_penapang}}
                                      </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label for="latitude">Lat</label>
                                        <input type="text" class="form-control" name="latitude" id="latitude" value="{{ $lampu->latitude }}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label for="longitude">Long</label>
                                        <input type="text" class="form-control" name="longitude" id="longitude" value="{{ $lampu->longitude }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                              <label for="ket">Keterangan</label>
                                  <select name="ket" id="ket" class="form-control">
                                    <option value="Hidup" @if ($lampu->ket == "Hidup")
                                      selected
                                    @endif>Hidup</option>
                                    <option value="Mati" @if ($lampu->ket == "Mati")
                                      selected
                                    @endif>Mati</option>
                                  </select>
                              </div>

                              <div class="form-group">
                                  <label for="gambar_lampu">Gambar Lampu</label>
                                    <img class="img_thumbnail" src="{{ asset('uploads/'.$lampu->gambar_lampu)}}" width="50px">
                              </div>

                            <div class="form-group">
                                <label for="gambar_lampu">Gambar Lampu</label>
                                  <input type="file" class="form-control" id="gambar_lampu" name="gambar_lampu" value="{{ old('gambar_lampu') }}">
                            </div>

                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                              <button type="submit" name="tombol" class="btn btn-info pull-right">Save</button>
                            </div>
                            <!-- /.box-footer -->
                        </form>
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
                    curLocation = [{{ $lampu->latitude }}, {{ $lampu->longitude }}];
                  }

                  var map = L.map('map').setView(curLocation, 15);

                  L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
                  }).addTo(map);

                  map.attributionControl.setPrefix(false);

                  var marker = new L.marker(curLocation, {
                    draggable: 'true'
                  })
                  .bindPopup("Nama lampu: {{ $lampu->no_lampu}}")
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
