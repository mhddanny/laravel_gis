@extends('layouts.template')
@section('title')
  Tambah  Maker Lampu
@endsection

@section('content')
  <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              @include('alert.error')
            </div>
            <div class="box-body">
                  <form class="form-horizontal" method="post" action="{{ route('marker.store') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                      <label for="kd_lampu" class="col-sm-2 control-label">Merek Lampu</label>
                      <div class="col-sm-10">
                        <select class="form-control" name="kd_lampu" id="kd_lampu">
                          <option value="">Pilih</option>
                            @foreach ($lampu as $row)
                              <option value="{{ $row->kd_lampu }}">
                                  {{ $row->no_lampu }}
                              </option>
                            @endforeach
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="latitude" class="col-sm-2 control-label">Lat</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="latitude" name="latitude" value="{{ old('latitude') }}">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="longitude" class="col-sm-2 control-label">Long</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="longitude" name="longitude" value="{{ old('longitude') }}">
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
                  <button type="submit" name="tombol" class="btn btn-info pull-right">Save</button>
                </div>
                <!-- /.box-footer -->
              </form>
            </div>
          </div>
        </div>
</div>
@endsection
