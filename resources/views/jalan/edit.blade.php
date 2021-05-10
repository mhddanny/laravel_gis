@extends('layouts.template')
@section('title')
  Update Data Jalan
@endsection

@section('content')
  <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              @include('alert.error')
            </div>
            <div class="box-body">
                  <form class="form-horizontal" method="post" action="{{ route('jalan.update',$jalan->kd_jalan) }}">
                  @csrf
                  {{ method_field('PUT') }}
                    <div class="form-group">
                      <label for="nama_jalan" class="col-sm-2 control-label">Nama Jalan</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama_jalan" name="nama_jalan" value="{{ $jalan->nama_jalan }}">
                      </div>
                    </div>

                      <div class="form-group">
                        <label for="kel" class="col-sm-2 control-label">Kelurahan</label>
                          <div class="col-sm-10">
                            <select name="kel" id="kel" class="form-control">
                              <option value="">Pilih</option>
                              <option value="Dompak" @if ($jalan->kel == "Dompak")selected @endif>Dompak</option>
                              <option value="Sei Jang" @if ($jalan->kel == "Sei Jang")selected @endif>Sei Jang</option>
                              <option value="Tanjung Ayun Sakti" @if ($jalan->kel == "Tanjung Ayun Sakti")selected @endif>Tanjung Ayun Sakti</option>
                              <option value="Tanjungpinang Timur" @if ($jalan->kel == "Tanjungpinang Timur")selected @endif>Tanjungpinang Timur</option>
                              <option value="Tanjung Unggat" @if ($jalan->kel == "Tanjung Unggat")selected @endif>Tanjung Unggat</option>

                              <option value="Bukit Cermin" @if ($jalan->kel == "Bukit Cermin")selected @endif>Bukit Cermin</option>
                              <option value="Kampung Baru" @if ($jalan->kel == "Kampung Baru")selected @endif>Kampung Baru</option>
                              <option value="Kemboja" @if ($jalan->kel == "Kemboja")selected @endif>Kemboja</option>
                              <option value="Tanjungpinang Barat" @if ($jalan->kel == "Tanjungpinang Barat")selected @endif>Tanjungpinang Barat</option>

                              <option value="Kampung Bugis" @if ($jalan->kel == "Kampung Bugis")selected @endif>Kampung Bugis</option>
                              <option value="Penyengat" @if ($jalan->kel == "Penyengat")selected @endif>Penyengat</option>
                              <option value="Senggarang" @if ($jalan->kel == "Senggarang")selected @endif>Senggarang</option>
                              <option value="Tanjungpinang Kota" @if ($jalan->kel == "Tanjungpinang Kota")selected @endif>Tanjungpinang Kota</option>

                              <option value="Air Raja" @if ($jalan->kel == "Air Raja")selected @endif>Air Raja</option>
                              <option value="Batu IX" @if ($jalan->kel == "BAtu IX")selected @endif>Batu IX</option>
                              <option value="Kampung Bulang" @if ($jalan->kel == "Kampung Bulang")selected @endif>Kampung Bulang</option>
                              <option value="Melayu Kota Piring" @if ($jalan->kel == "Melayu Kota Piring")selected @endif>Melayu Kota Piring</option>
                              <option value="Pinang Kencana" @if ($jalan->kel == "Pinang Kencana")selected @endif>Pinang Kencana</option>
                            </select>
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="kec" class="col-sm-2 control-label">Kecamatan</label>
                            <div class="col-sm-10">
                              <select name="kec" id="kec" class="form-control">
                                <option value="">Pilih</option>
                                <option value="Bukit Bestari" @if ($jalan->kec == "Bukit Bestari")selected @endif>Bukit Bestari</option>
                                <option value="Barat" @if ($jalan->kec == "Barat")selected @endif>Barat</option>
                                <option value="Kota" @if ($jalan->kec == "Kota")selected @endif>Kota</option>
                                <option value="Timur"@if ($jalan->kec == "Timur")selected @endif>Timur</option>
                              </select>
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="rt_rw" class="col-sm-2 control-label">Rt/Rw</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="rt_rw" name="rt_rw" value="{{ $jalan->rt_rw }}">
                          </div>
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
        </div>
</div>
@endsection
