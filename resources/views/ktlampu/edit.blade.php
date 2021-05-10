@extends('layouts.template')
@section('title')
  Upadate Data Kategori Lampu
@endsection

@section('content')
  <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              @include('alert.error')
            </div>
            <div class="box-body">
                  <form class="form-horizontal" method="post" action="{{ route('ktlampu.update',$ktlampu->kt_lampu)}}" enctype="multipart/form-data">
                    @csrf
                    {{method_field('PUT')}}
                    <div class="form-group">
                      <label for="nama_lampu" class="col-sm-2 control-label">Merk Lampu</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama_lampu" name="nama_lampu" value="{{ $ktlampu->nama_lampu }}">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="kt" class="col-sm-2 control-label">Jenis Lampu</label>
                        <div class="col-sm-10">
                          <select name="kt" id="kt" class="form-control">
                            <option>Pilih :</option>
                            <option value="Son-T" @if ($ktlampu->kt == "Son-T")selected @endif> Son-T </option>
                            <option value="Led COB" @if ($ktlampu->kt == "Led COB")selected   @endif> Led COB </option>
                            <option value="Led Multi" @if ($ktlampu->kt == "Led Multi")selected @endif> Led Multi </option>
                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="daya" class="col-sm-2 control-label">Daya</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="daya" name="daya" value="{{ $ktlampu->daya }}">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="gambar_kt_lampu" class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                          <img class="img_thumbnail" src="{{ asset('uploads/'.$ktlampu->gambar_kt_lampu) }}" width="100px" />
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="gambar_kt_lampu" class="col-sm-2 control-label">Gambar Kategorin Lampu</label>
                        <div class="col-sm-10">
                          <input type="file" class="form-control" id="gambar_kt_lampu" name="gambar_kt_lampu" value="{{ old('gambar_kt_lampu') }}">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="gbr" class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                          <img class="img_thumbnail" src="{{ asset('uploads/'.$ktlampu->gbr) }}" width="100px" />
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="gbr" class="col-sm-2 control-label">Marker</label>
                        <div class="col-sm-10">
                          <input type="file" class="form-control" id="gbr" name="gbr" value="{{ old('gbr') }}">
                        </div>
                      </div>

                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                  <button type="update" name="tombol" class="btn btn-info pull-right">Save</button>
                </div>
                <!-- /.box-footer -->
              </form>
            </div>
          </div>
        </div>
</div>
@endsection
