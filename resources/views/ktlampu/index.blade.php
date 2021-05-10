@extends('layouts.template')

@section('title')
  Data Kategori Lampu
@endsection

@section('content')
  <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">

              @if (Request::get('keyword'))
                <a class="btn btn-success" href="{{ route('ktlampu.index') }}"> Back </a>
              @else
                <a class="btn btn-success" href="{{ route('ktlampu.create') }}"><span class="glyphicon glyphicon-plus"></span> Create </a>
              @endif

              {{-- <form method="get" action="{{route('ktlampu.index')}}">
                <div class="form-group">
                  <label for="keyword" class="col-sm-2 control-label">Search By Name</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="keyword" name="keyword" value="{{Request::get('keyword')}}">
                  </div>
                  <div class="col-sm-6">
                    <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-search"></span></button>
                  </div>
                </div>
              </form> --}}

            </div>
            <div class="box-body">

              @if (Request::get('keyword'))
                  <div class="alert alert-success alert-block">
                    Hasil Pencarian dengan keyword : <b>{{ Request::get('keyword') }}</b>
                  </div>
              @endif

              @include('alert.succes')
                <table class="table table-bordered" id="datatable">
                  <thead>
                    <tr>
                      <th width="5%">No</th>
                      <th>Merk Lampu</th>
                      <th>Jenis Lampu</th>
                      <th>Daya</th>
                      <th>Gambar</th>
                      <th>Marker</th>
                      <th width="30%">Ation</th>
                    </tr>
                    <tbody>
                        @foreach ($ktlampu as $row)
                            <tr>
                              <td>{{ $loop->iteration + ($ktlampu->perpage() * ($ktlampu->currentPage() - 1 )) }}</td>
                              <td>{{ $row->nama_lampu }}</td>
                              <td>{{ $row->kt }}</td>
                              <td>{{ $row->daya }}</td>
                              <td><img src="{{ asset('uploads/'.$row->gambar_kt_lampu) }}" width="50px"> </td>
                              <td><img src="{{ asset('uploads/'.$row->gbr) }}" width="30px"> </td>
                              <td>
                                <form class="" action="{{ route('ktlampu.destroy',[$row->kt_lampu]) }}" method="post"
                                  onsubmit="return confirm('Apakah Anda Yakin Akan Menghapus Data ini ?')">
                                  @csrf
                                  {{ method_field('Delete') }}
                                  <a class="btn btn-warning" href="{{ route('ktlampu.edit',[$row->kt_lampu]) }}">Edit</a>
                                  <button type="submit" name="button" class="btn btn-danger">Delete</button>
                                </form>
                              </td>
                           </tr>
                        @endforeach
                    </tbody>
                  </thead>
                </table>
                {{-- {{ $ktlampu->appends(Request::all())->links() }} --}}
            </div>
          </div>
        </div>
</div>
@endsection
@section('footer')
  <script type="text/javascript">
    $(document).ready(function(){
      $('#datatable').DataTable();
    });
  </script>
@endsection
