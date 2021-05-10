@extends('layouts.template')

@section('title')
  Data Tiang
@endsection

@section('content')
  <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">

              @if (Request::get('keyword'))
                <a class="btn btn-success" href="{{ route('tiang.index') }}"> Back </a>
              @else
                <a class="btn btn-success" href="{{ route('tiang.create') }}"><span class="glyphicon glyphicon-plus"></span> Create </a>
              @endif

              {{-- <form method="get" action="{{route('tiang.index')}}">
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
                      <th>Status Ting</th>
                      <th>Jenis Tiang</th>
                      <th>Bentuk Tiang</th>
                      <th>Panjang Tiang</th>
                      <th>Diameter Tiang</th>
                      <th width="30%">Ation</th>
                    </tr>
                    <tbody>
                        @foreach ($tiang as $row)
                            <tr>
                              <td>{{ $loop->iteration + ($tiang->perpage() * ($tiang->currentPage() - 1 )) }}</td>
                              <td>{{ $row->nm }}</td>
                              <td>{{ $row->jns }}</td>
                              <td>{{ $row->knt }}</td>
                              <td>{{ $row->panjang }}</td>
                              <td>{{ $row->diameter }}</td>
                              <td>
                                <form class="" action="{{ route('tiang.destroy',[$row->kd_tiang]) }}" method="post"
                                  onsubmit="return confirm('Apakah Anda Yakin Akan Menghapus Data ini ?')">
                                  @csrf
                                  {{ method_field('Delete') }}
                                  <a class="btn btn-info" href="{{ route('tiang.show',[$row->kd_tiang]) }}">Detail</a>
                                  <button type="submit" name="button" class="btn btn-danger">Delete</button>
                                </form>
                              </td>
                           </tr>
                        @endforeach
                    </tbody>
                  </thead>
                </table>
                {{-- {{ $tiang->appends(Request::all())->links() }} --}}
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
