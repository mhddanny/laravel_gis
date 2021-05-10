@extends('layouts.template')
@section('title')
  Tambah Data Pegawai
@endsection

@section('content')
  <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              @include('alert.error')
            </div>
            <div class="box-body">
                  <form class="form-horizontal" method="post" action="{{ route('tiang.store') }}" enctype="multipart/form-data">
                {{ csrf_field() }}

                  <div class="form-group">
                    <label for="nm" class="col-sm-2 control-label">Status Tiang</label>
                      <div class="col-sm-10">
                        <select name="nm" id="nm" class="form-control">
                          <option value="">Pilih</option>
                          <option value="PLN">PLN</option>
                          <option value="PEMKO">PEMKO</option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="jns" class="col-sm-2 control-label">Jenis Tiang</label>
                        <div class="col-sm-10">
                          <select name="jns" id="jns" class="form-control">
                            <option value="">Pilih</option>
                            <option value="Besi">Besi</option>
                            <option value="Beton">Beton</option>
                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="knt" class="col-sm-2 control-label">Bentuk Tiang</label>
                          <div class="col-sm-10">
                            <select name="knt" id="knt" class="form-control">
                              <option value="">Pilih</option>
                              <option value="Single Arm">Single Arm</option>
                              <option value="Double Arm">Double Arm</option>
                              <option value="Threth Arm">Threth Arm</option>
                              <option value="Forth Arm">Forth Arm</option>
                              <option value="Lurus">Lurus</option>
                            </select>
                          </div>
                        </div>

                      <div class="form-group">
                        <label for="panjang" class="col-sm-2 control-label">Panjang Tiang</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="panjang" name="panjang" value="{{ old('panjang') }}">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="diameter" class="col-sm-2 control-label">Diameter Clem</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="diameter" name="diameter" value="{{ old('diameter') }}">
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
