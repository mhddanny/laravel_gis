@extends('layouts.template')
@section('title')
  Tambah Kategori Lampu
@endsection

@section('content')
  <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              @include('alert.error')
            </div>
            <div class="box-body">
                  <form class="form-horizontal" method="post" action="{{ route('ktlampu.store') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <div class="form-group">
                      <label for="nama_lampu" class="col-sm-2 control-label">Merk Lampu</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama_lampu" name="nama_lampu" value="{{ old('nama_lampu') }}">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="kt" class="col-sm-2 control-label">Jenis Lampu</label>
                        <div class="col-sm-10">
                          <select name="kt" id="kt" class="form-control">
                            <option value="">Pilih</option>
                            <option value="SON-T">SON-T</option>
                            <option value="Led COB">Led COB</option>
                            <option value="Led Multi">Led Multi</option>
                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="daya" class="col-sm-2 control-label">Daya</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="daya" name="daya" value="{{ old('daya') }}">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="gambar_kt_lampu" class="col-sm-2 control-label">Gambar Photo Lampu</label>
                        <div class="col-sm-10">
                          <input type="file" class="form-control" id="gambar_kt_lampu" name="gambar_kt_lampu" value="{{ old('gambar_kt_lampu') }}">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="gbr" class="col-sm-2 control-label">Gambar Marker</label>
                        <div class="col-sm-10">
                          <input type="file" class="form-control" id="gbr" name="gbr" value="{{ old('gbr') }}">
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
