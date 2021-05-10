@extends('layouts.template')
@section('title')
  Upadate Data Jaringan
@endsection

@section('content')
  <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              @include('alert.error')
            </div>
            <div class="box-body">
                  <form class="form-horizontal" method="post" action="{{ route('jaringan.update',$jaringan->kd_jaringan)}}" enctype="multipart/form-data">
                    @csrf
                    {{method_field('PUT')}}
                    <div class="form-group">
                      <label for="nama_jaringan" class="col-sm-2 control-label">Nama Jaringan</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama_jaringan" name="nama_jaringan" value="{{ $jaringan->nama_jaringan }}">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="jr" class="col-sm-2 control-label">Jenis Jaringan</label>
                        <div class="col-sm-10">
                          <select name="jr" id="jr" class="form-control">
                            <option>Pilih :</option>
                            <option value="Kabel Tanah" @if ($jaringan->jr == "Kabel Tanah")selected @endif> Kabel Tanah</option>
                            <option value="Kabel Udara" @if ($jaringan->jr == "Kabel Udara")selected   @endif> Kabel Udara</option>
                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="luas_penapang" class="col-sm-2 control-label">Luas Penampang</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="luas_penapang" name="luas_penapang" value="{{ $jaringan->luas_penapang }}">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="gambar_jaringan" class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                          <img class="img_thumbnail" src="{{ asset('uploads/'.$jaringan->gambar_jaringan) }}" width="100px" />
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="gambar_jaringan" class="col-sm-2 control-label">Gambar Jaringan</label>
                        <div class="col-sm-10">
                          <input type="file" class="form-control" id="gambar_jaringan" name="gambar_jaringan" value="{{ old('gambar_jaringan') }}">
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
