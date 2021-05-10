@extends('layouts.template')
@section('title')
  Tambah Data Jalan
@endsection

@section('content')
  <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              @include('alert.error')
            </div>
            <div class="box-body">
                  <form class="form-horizontal" method="post" action="{{ route('jalan.store') }}">
                {{ csrf_field() }}
                    <div class="form-group">
                      <label for="nama_jalan" class="col-sm-2 control-label">Nama Jalan</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama_jalan" name="nama_jalan" value="{{ old('nama_jalan') }}">
                      </div>
                    </div>

                    <div class="form-group">
                          <label for="kec" class="col-sm-2 control-label">Kecamatan</label>
                            <div class="col-sm-10">
                              <select name="kec" id="kec" class="form-control">
                                <option value="">Pilih</option>
                                <option value="Bukit Bestari">Bukit Bestari</option>
                                <option value="Barat">Barat</option>
                                <option value="Kota">Kota</option>
                                <option value="Timur">Timur</option>
                              </select>
                          </div>
                    </div>

                      <div class="form-group">
                        <label for="kel" class="col-sm-2 control-label">Kelurahan</label>
                          <div class="col-sm-10">
                            <select name="kel" id="kel" class="form-control">
                              <option value="">Pilih</option>
                              <option value="Dompak">Dompak</option>
                              <option value="Sei Jang">Sei Jang</option>
                              <option value="Tanjung Ayun Sakti">Tanjung Ayun Sakti</option>
                              <option value="Tanjungpinang Timur">Tanjungpinang Timur</option>
                              <option value="Tanjung Unggat">Tanjung Unggat</option>

                              <option value="Bukit Cermin">Bukit Cermin</option>
                              <option value="Kampung Baru">Kampung Baru</option>
                              <option value="Kemboja">Kemboja</option>
                              <option value="Tanjungpinang Barat">Tanjungpinang Barat</option>

                              <option value="Kampung Bugis">Kampung Bugis</option>
                              <option value="Penyengat">Penyengat</option>
                              <option value="Senggarang">Senggarang</option>
                              <option value="Tanjungpinang Kota">Tanjungpinang Kota</option>

                              <option value="Air Raja">Air Raja</option>
                              <option value="Batu IX">Batu IX</option>
                              <option value="Kampung Bulang">Kampung Bulang</option>
                              <option value="Melayu Kota Piring">Melayu Kota Piring</option>
                              <option value="Pinang Kencana">Pinang Kencana</option>
                            </select>
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="rt_rw" class="col-sm-2 control-label">Rt/Rw</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="rt_rw" name="rt_rw" value="{{ old('rt_rw') }}">
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
